<template>
    <div class="flex-grow-1 d-flex flex-column overflow-auto">
        <div class="accordion pt-2 flex-grow-1 shadow overflow-auto" id="accordionExample">
            <div v-if="listadoSolicitudesEstaCargando" class="d-flex my-2 justify-content-center align-items-center">
                <strong class="text-primary">Buscando solicitudes...</strong>
                <div class="ml-1 spinner-border text-primary" role="status" aria-hidden="true"></div>
            </div>
            <div v-if="listadoSolicitudesEstaVacio" class="mb-2 text-center text-primary">
                No se encontraron solicitudes de quirófano
            </div>
            <!-- v-if="item.dias.length > 0" -->
            <div :key="'solicitudes_' + index" v-for="(item, index) in listadoSolicitudesQx" class="card mb-2">
                <div class="card-header p-1" :id="'headingOne' + index">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block d-flex justify-content-start  align-items-center"
                            type="button" data-toggle="collapse" :data-target="'#collapseOne' + index"
                            :aria-expanded="[item.dias.length === 1 ? true : false]"
                            :aria-controls="'collapseOne' + index">

                            <h5 class="mb-0 "><b>{{ formatTabFecha(item.fecha)[2] }}</b> {{
                formatTabFecha(item.fecha)[1] }}</h5>
                            <div class="mx-3 font-weight-bold">|</div>
                            <div title="Total Programadas:">
                                <i class="fas fa-calendar-alt mr-1"></i>
                                <h5 class="mb-0 mt-1 badge badge-primary">{{ item.dias.length }}</h5>
                            </div>

                            <div :class="{ 'd-flex align-items-center mr-1': true, 'd-none': item.dias.length === 0 }"
                                title="Total Ejecutadas:">
                                <div class="mx-3 font-weight-bold">|</div>
                                <i
                                    :class="{ 'fas fa-check mr-1': true, 'text-purple': item.dias.filter(x => x.h_fin !== null).length > 0, 'text-secondary': item.dias.filter(x => x.h_fin !== null).length === 0 }"></i>
                                <h5
                                    :class="{ 'mb-0 mt-1 badge ': true, 'badge-purple': item.dias.filter(x => x.h_fin !== null).length > 0, 'badge-secondary': item.dias.filter(x => x.h_fin !== null).length === 0 }">
                                    {{ item.dias.filter(x => x.h_fin !== null).length }}
                                </h5>

                            </div>

                        </button>
                    </h2>
                </div>

                <div :id="'collapseOne' + index" :class="['collapse', { 'show': item.dias.length === 1 }]"
                    :aria-labelledby="'headingOne' + index" data-parent="#accordionExample">
                    <div class="card-body table-responsive p-1 pb-5">
                        <table class="table table-bordered mb-5 border-0">
                            <thead v-if="existenSolicitudesQx">
                                <tr class="text-center sticky bg-primary">
                                    <th class="tbl-row-radius-left">Qx</th>
                                    <th>Fecha Programación</th>
                                    <th>Paciente</th>
                                    <th>Intervención</th>
                                    <th>Cirujano Principal</th>
                                    <th>Anestesiólogo</th>
                                    <th class="d-none">Equipos Especiales</th>
                                    <th>Personal Asistencial</th>
                                    <th>Área IQX</th>
                                    <th>Destino</th>
                                    <th class="tbl-row-radius-right">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                                <tr v-for="(item2, index2) in item.dias" :key="'sol_' + index2">
                                    <!-- n quirofano -->
                                    <th class="p-1 btn tbl-row-radius-left h4 mb-0 valign-center text-center"
                                        :style="{ 'display': 'table-cell', 'vertical-align': 'middle' }">
                                        <div class="d-flex flex-column">
                                            <div class="d-flex">
                                                <div class="flex-grow-1 d-flex justify-content-center btn-group dropup ">
                                                    <button 
                                                        v-if="!item2.h_fin"
                                                        title="Número de Quirófano" class="btn-link btn cursor-pointer"
                                                        type="button" id="triggerId" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false">
                                                        <h1 v-if="[1,2,3,4,5,6,7,8,9].includes(item2.n_quirofano)" class="font-weight-bold"
                                                            :style="{ 'color': getBgColor(item2.n_quirofano) }">
                                                            QX{{item2.n_quirofano }}</h1>
                                                        <h1 v-else-if="item2.n_quirofano === 10" class="font-weight-bold"
                                                            :style="{ 'color': getBgColor(item2.n_quirofano) }">SEE</h1>
                                                        <h1 v-else class="font-weight-bold" style="color:red">P</h1>


                                                    </button>
                                                    <div v-else >
                                                        <h1 
                                                        v-if="[1,2,3,4,5,6,7,8,9].includes(item2.n_quirofano)" 
                                                        class="font-weight-bold"
                                                        :style="{ 'color': getBgColor(item2.n_quirofano) }"
                                                        >
                                                            QX{{item2.n_quirofano }}
                                                        </h1>
                                                    </div>
                                                    <div style="height: 250px;" class="dropdown-menu dropdown-menu-top overflow-auto"
                                                        aria-labelledby="triggerId">

                                                        <a @click="handleFaseUbicacion" data-input_name="n_quirofano"
                                                            :data-index="index" :data-index2="index2"
                                                            :data-reservacion_id="item2.id" :data-input_value="1000"
                                                            :class="{ 'dropdown-item': true, 'active': item2.n_quirofano === 1000 }"
                                                            href="#">
                                                            Pendiente
                                                        </a>
                                                        <a @click="handleFaseUbicacion" data-input_name="n_quirofano"
                                                            :data-index="index" :data-index2="index2"
                                                            :data-reservacion_id="item2.id" :data-input_value="1"
                                                            :class="{ 'dropdown-item': true, 'active': item2.n_quirofano === 1 }"
                                                            href="#">
                                                            QX1
                                                        </a>
                                                        <a @click="handleFaseUbicacion" data-input_name="n_quirofano"
                                                            :data-index="index" :data-index2="index2"
                                                            :data-reservacion_id="item2.id" :data-input_value="2"
                                                            :class="{ 'dropdown-item': true, 'active': item2.n_quirofano === 2 }"
                                                            href="#">
                                                            QX2
                                                        </a>
                                                        <a @click="handleFaseUbicacion" data-input_name="n_quirofano"
                                                            :data-index="index" :data-index2="index2"
                                                            :data-reservacion_id="item2.id" :data-input_value="3"
                                                            :class="{ 'dropdown-item': true, 'active': item2.n_quirofano === 3 }"
                                                            href="#">
                                                            QX3
                                                        </a>
                                                        <a @click="handleFaseUbicacion" data-input_name="n_quirofano"
                                                            :data-index="index" :data-index2="index2"
                                                            :data-reservacion_id="item2.id" :data-input_value="4"
                                                            :class="{ 'dropdown-item': true, 'active': item2.n_quirofano === 4 }"
                                                            href="#">
                                                            QX4
                                                        </a>
                                                        <a @click="handleFaseUbicacion" data-input_name="n_quirofano"
                                                            :data-index="index" :data-index2="index2"
                                                            :data-reservacion_id="item2.id" :data-input_value="5"
                                                            :class="{ 'dropdown-item': true, 'active': item2.n_quirofano === 5 }"
                                                            href="#">
                                                            QX5
                                                        </a>
                                                        <!-- <a  @click="handleFaseUbicacion"
                                                            data-input_name="n_quirofano"
                                                            :data-index="index" :data-index2="index2"
                                                            :data-reservacion_id="item2.id"
                                                            :data-input_value="5"
                                                            :class="{'dropdown-item':true, 'active': item2.n_quirofano===5 }" href="#">
                                                            QX5
                                                        </a> -->
                                                        <a @click="handleFaseUbicacion" data-input_name="n_quirofano"
                                                            :data-index="index" :data-index2="index2"
                                                            :data-reservacion_id="item2.id" :data-input_value="6"
                                                            :class="{ 'dropdown-item': true, 'active': item2.n_quirofano === 6 }"
                                                            href="#">
                                                            QX6
                                                        </a>
                                                        <a @click="handleFaseUbicacion" data-input_name="n_quirofano"
                                                            :data-index="index" :data-index2="index2"
                                                            :data-reservacion_id="item2.id" :data-input_value="7"
                                                            :class="{ 'dropdown-item': true, 'active': item2.n_quirofano === 7 }"
                                                            href="#">
                                                            QX7
                                                        </a>
                                                        <a @click="handleFaseUbicacion" data-input_name="n_quirofano"
                                                            :data-index="index" :data-index2="index2"
                                                            :data-reservacion_id="item2.id" :data-input_value="8"
                                                            :class="{ 'dropdown-item': true, 'active': item2.n_quirofano === 8 }"
                                                            href="#">
                                                            QX8
                                                        </a>
                                                        <a @click="handleFaseUbicacion" data-input_name="n_quirofano"
                                                            :data-index="index" :data-index2="index2"
                                                            :data-reservacion_id="item2.id" :data-input_value="9"
                                                            :class="{ 'dropdown-item': true, 'active': item2.n_quirofano === 9 }"
                                                            href="#">
                                                            QX9
                                                        </a>
                                                        <a @click="handleFaseUbicacion" data-input_name="n_quirofano"
                                                            :data-index="index" :data-index2="index2"
                                                            :data-reservacion_id="item2.id" :data-input_value="10"
                                                            :class="{ 'dropdown-item': true, 'active': item2.n_quirofano === 10 }"
                                                            href="#">
                                                            Sala de estudios especiales
                                                        </a>


                                                    </div>
                                                </div>
                                                <div v-if="item2.n_quirofano !== 1000" class="btn-group btn-link ">
                                                    <button title="Fase de la intervención" class="btn cursor-pointer"
                                                        type="button" id="triggerId" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-stream"
                                                            :style="{ 'color': getBgColor(item2.n_quirofano) }"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right"
                                                        aria-labelledby="triggerId">

                                                        <a @click="handleFaseUbicacion" data-input_name="fase_ubicacion"
                                                            :data-index="index" :data-index2="index2"
                                                            :data-reservacion_id="item2.id"
                                                            :data-input_value="'Sin Estatus'"
                                                            :class="{ 'dropdown-item': true, 'active': item2.fase_ubicacion === 'Sin Estatus' }"
                                                            href="#">
                                                            Sin Estatus
                                                        </a>
                                                        <a @click="handleFaseUbicacion" data-input_name="fase_ubicacion"
                                                            :data-index="index" :data-index2="index2"
                                                            :data-reservacion_id="item2.id"
                                                            :data-input_value="'En espera de clave'"
                                                            :class="{ 'dropdown-item': true, 'active': item2.fase_ubicacion === 'En espera de clave' }"
                                                            href="#">
                                                            En espera de clave
                                                        </a>
                                                        <a @click="handleFaseUbicacion" data-input_name="fase_ubicacion"
                                                            :data-index="index" :data-index2="index2"
                                                            :data-reservacion_id="item2.id"
                                                            :data-input_value="'Pre-anestesia'"
                                                            :class="{ 'dropdown-item': true, 'active': item2.fase_ubicacion === 'Pre-anestesia' }"
                                                            href="#">
                                                            Pre-anestesia
                                                        </a>
                                                        <a @click="handleFaseUbicacion" data-input_name="fase_ubicacion"
                                                            :data-index="index" :data-index2="index2"
                                                            :data-reservacion_id="item2.id"
                                                            :data-input_value="'En quirófano'"
                                                            :class="{ 'dropdown-item': true, 'active': item2.fase_ubicacion === 'En quirófano' }"
                                                            href="#">
                                                            En quirófano
                                                        </a>
                                                        <a @click="handleFaseUbicacion" data-input_name="fase_ubicacion"
                                                            :data-index="index" :data-index2="index2"
                                                            :data-reservacion_id="item2.id"
                                                            :data-input_value="'Recuperación'"
                                                            :class="{ 'dropdown-item': true, 'active': item2.fase_ubicacion === 'Recuperación' }"
                                                            href="#">
                                                            Recuperación
                                                        </a>
                                                        <a @click="handleFaseUbicacion" data-input_name="fase_ubicacion"
                                                            :data-index="index" :data-index2="index2"
                                                            :data-reservacion_id="item2.id"
                                                            :data-input_value="'Hospitalización'"
                                                            :class="{ 'dropdown-item': true, 'active': item2.fase_ubicacion === 'Hospitalización' }"
                                                            href="#">
                                                            Hospitalización
                                                        </a>
                                                        <a @click="handleFaseUbicacion" data-input_name="fase_ubicacion"
                                                            :data-index="index" :data-index2="index2"
                                                            :data-reservacion_id="item2.id" :data-input_value="'UTI'"
                                                            :class="{ 'dropdown-item': true, 'active': item2.fase_ubicacion === 'UTI' }"
                                                            href="#">
                                                            UTI
                                                        </a>
                                                        <a @click="handleFaseUbicacion" data-input_name="fase_ubicacion"
                                                            :data-index="index" :data-index2="index2"
                                                            :data-reservacion_id="item2.id" :data-input_value="'Alta'"
                                                            :class="{ 'dropdown-item': true, 'active': item2.fase_ubicacion === 'Alta' }"
                                                            href="#">
                                                            Alta
                                                        </a>
                                                        <a @click="handleFaseUbicacion" data-input_name="fase_ubicacion"
                                                            :data-index="index" :data-index2="index2"
                                                            :data-reservacion_id="item2.id"
                                                            :data-input_value="'Suspendida'"
                                                            :class="{ 'dropdown-item': true, 'active': item2.fase_ubicacion === 'Suspendida' }"
                                                            href="#">
                                                            Suspendida
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div v-if="item2.n_quirofano !== 1000">
                                                <div :class="{ 'flex-column h5 text-white bg-clave-espera d-none': true, 'd-flex': item2.fase_ubicacion === 'En espera de clave' }"
                                                    style="font-size: 1rem;border-radius: 5px;padding: 0.2rem;">
                                                    <div class="text-nowrap">
                                                        <i :class="{ 'fas fa-key': true, 'd-none': false }"></i> En
                                                        espera
                                                        de clave
                                                    </div>

                                                </div>
                                                <div :class="{ 'flex-column h5 text-secondary bg-preanestesia d-none': true, 'd-flex': item2.fase_ubicacion === 'Pre-anestesia' }"
                                                    style="font-size: 1rem;border-radius: 5px;padding: 0.2rem;">
                                                    <div class="text-nowrap"><i
                                                            :class="{ 'fas fa-syringe': true, 'd-none': false }"></i>
                                                        Pre-anestesia</div>

                                                </div>
                                                <div :class="{ 'flex-column blink-2 h5 text-secondary bg-quirofano d-none': true, 'd-flex': item2.fase_ubicacion === 'En quirófano' }"
                                                    style="font-size: 1rem;border-radius: 5px;padding: 0.2rem;">
                                                    <div class="text-nowrap"><i
                                                            :class="{ 'pc-cirugia': true, 'd-none': false }"></i> En
                                                        Quirófano</div>

                                                </div>
                                                <div :class="{ 'flex-column h5 text-secondary bg-recuperacion d-none': true, 'd-flex': item2.fase_ubicacion === 'Recuperación' }"
                                                    style="font-size: 1rem;border-radius: 5px;padding: 0.2rem;">
                                                    <div class="text-nowrap"><i
                                                            :class="{ 'fas fa-check': true, 'd-none': false }"></i> En
                                                        Recuperación</div>

                                                </div>
                                                <div :class="{ 'flex-column h5 text-secondary bg-hospitalizacion d-none': true, 'd-flex': item2.fase_ubicacion === 'Hospitalización' }"
                                                    style="font-size: 1rem;border-radius: 5px;padding: 0.2rem;">
                                                    <div class="text-nowrap"><i
                                                            :class="{ 'pc-light-pisos': true, 'd-none': false }"></i>
                                                        Hospitalización</div>

                                                </div>
                                                <div :class="{ 'flex-column h5 text-secondary bg-uti d-none': true, 'd-flex': item2.fase_ubicacion === 'UTI' }"
                                                    style="font-size: 1rem;border-radius: 5px;padding: 0.2rem;">
                                                    <div class="text-nowrap"><i
                                                            :class="{ 'pc-uti-light': true, 'd-none': false }"></i> UTI
                                                    </div>

                                                </div>
                                                <div :class="{ 'flex-column h5 text-secondary bg-alta d-none': true, 'd-flex': item2.fase_ubicacion === 'Alta' }"
                                                    style="font-size: 1rem;border-radius: 5px;padding: 0.2rem;">
                                                    <div class="text-nowrap"><i
                                                            :class="{ 'pc-check': true, 'd-none': false }"></i> Alta
                                                    </div>

                                                </div>
                                                <div :class="{ 'flex-column h5 text-white bg-secondary d-none': true, 'd-flex': item2.fase_ubicacion === 'Suspendida' }"
                                                    style="font-size: 1rem;border-radius: 5px;padding: 0.2rem;">
                                                    <div class="text-nowrap"><i :class="{ 'fas fa-check': true }"></i>
                                                        Suspendida</div>

                                                </div>
                                                <div title="Hora de fín de la IQX" v-if="item2.h_fin !== null"
                                                    class="text-white bg-purple"
                                                    style="font-size: 1rem;border-radius: 5px;padding: 0.2rem;">
                                                    Finalizó a las<br>{{ horaAMPM(item2.h_fin) }} <i
                                                        class="fas fa-check-double"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </th>
                                    <!-- fechas programacion -->
                                    <td class="p-1 text-center">
                                        <div class="d-flex flex-column">
                                            <div
                                                :class="['btn-group', { 'd-none': item2.fase_ubicacion === 'En espera de clave' }]">
                                                <button
                                                    v-if="!item2.h_fin"
                                                    class="btn-link rounded text-nowrap bg-transparent border-0 text-secondary"
                                                    type="button" id="triggerId" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false" style="
                                                        font-size: 1.2rem;
                                                    ">
                                                    <i class="fas fa-calendar-alt text-primary"></i> 
                                                    {{ fechaFormat(item2.fecha_reservacion ? item2.fecha_reservacion : item2.fecha_reservacion_original) }}
                                                </button>
                                                <div v-else>
                                                    <i class="fas fa-calendar-alt text-primary"></i> 
                                                    {{ fechaFormat(item2.fecha_reservacion ? item2.fecha_reservacion : item2.fecha_reservacion_original) }}
                                                </div>
                                                <div @click="dropdownStop" class="dropdown-menu dropdown-menu-right"
                                                    aria-labelledby="triggerId">
                                                    <div class="dropdown-item">
                                                        <div class="d-flex">
                                                            <input :id="'fecha_reservacion_' + item2.id"
                                                                :ref="'fecha_reservacion_' + item2.id" type="date"
                                                                class="form-control flex-grow-1"
                                                                name="fecha_reservacion"
                                                                :data-h_aprox_fin="item2.h_aprox_fin"
                                                                :data-id_programacion="item2.id"
                                                                :value="item2.fecha_reservacion ? item2.fecha_reservacion : item2.fecha_reservacion_original"
                                                                @keyup.enter="handleFechaProgramacion"
                                                                data-input_name="h_inicio"
                                                                :data-refValue="'fecha_reservacion_' + item2.id"
                                                                :data-index="index" :data-index2="index2"
                                                                :data-reservacion_id="item2.id">

                                                            <button @click="handleFechaProgramacion"
                                                                data-input_name="h_inicio"
                                                                :data-refValue="'fecha_reservacion_' + item2.id"
                                                                :data-index="index" :data-index2="index2"
                                                                :data-reservacion_id="item2.id"
                                                                class="ml-1 btn-sm btn btn-outline-success"
                                                                title="Actualizar">&#9998;
                                                            </button>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div
                                                :class="['btn-group', { 'd-none': item2.fase_ubicacion === 'En espera de clave' || item2.n_quirofano === 1000 }]">
                                                <button 
                                                    v-if="!item2.h_fin"
                                                    class="btn-link rounded bg-transparent border-0 text-secondary"
                                                    type="button" id="triggerId" data-toggle="dropdown"
                                                    aria-haspopup="true" 
                                                    aria-expanded="false" 
                                                    style="
                                                        font-size: 1.2rem;
                                                    ">
                                                    <i :class="[{ 'pc-clock-update text-orange': getHistorialHorasQx(item2).length > 1 }, { 'fas fa-clock text-success': getHistorialHorasQx(item2).length === 1 }]"></i>
                                                    {{ 
                                                        item2['h_inicio'] && item2['h_real_inicio'] 
                                                        ? horaAMPM(JSON.parse(item2['h_real_inicio'])[JSON.parse(item2['h_real_inicio']).length - 1]['h_inicio']) 
                                                        : '--:--'
                                                    }}
                                                </button>
                                                <div v-else>
                                                    <i :class="[{ 'pc-clock-update text-orange': getHistorialHorasQx(item2).length > 1 }, { 'fas fa-clock text-success': getHistorialHorasQx(item2).length === 1 }]"></i>
                                                    {{ 
                                                        item2['h_inicio'] && item2['h_real_inicio'] 
                                                        ? horaAMPM(JSON.parse(item2['h_real_inicio'])[JSON.parse(item2['h_real_inicio']).length - 1]['h_inicio']) 
                                                        : '--:--'
                                                    }}
                                                </div>
                                                <!-- {{ item2 }} -->
                                                <!-- :value="horaAMPM2(getHRealInicio(item2))" -->
                                                <div @click="dropdownStop" class="dropdown-menu dropdown-menu-right"
                                                    aria-labelledby="triggerId">
                                                    <div class="dropdown-item">
                                                        <div class="d-flex">
                                                            <input 
                                                                :id="'h_real_inicio_' + item2.id"
                                                                :ref="'h_real_inicio' + item2.id" 
                                                                type="time"
                                                                class="form-control flex-grow-1" 
                                                                name="h_real_inicio"
                                                                :data-id_programacion="item2.id"
                                                                
                                                                @keyup.enter="handlehoraProgramacion"
                                                                data-input_name="h_real_inicio"
                                                                :data-refValue="'h_real_inicio' + item2.id"
                                                                :data-index="index" 
                                                                :data-index2="index2"
                                                                :data-reservacion_id="item2.id"
                                                            >
                                                            <button @click="handlehoraProgramacion"
                                                                data-input_name="h_real_inicio"
                                                                :data-refValue="'h_real_inicio' + item2.id"
                                                                :data-index="index" :data-index2="index2"
                                                                :data-reservacion_id="item2.id"
                                                                class="ml-1 btn-sm btn btn-outline-success"
                                                                title="Actualizar">&#9998;
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="p-1">
                                                        <table class="w-100">
                                                            <thead>
                                                                <tr>
                                                                    <th title="Historial de reprogramaciones."
                                                                        class="text-primary text-center p-1">Historial</th>
                                                                </tr>    
                                                            </thead>
                                                            
                                                            <tbody v-if="getHistorialHorasQx(item2).length > 0">
                                                                <tr v-for="(item4, index4) in getHistorialHorasQx(item2) " :key="'sol2_' + index4">
                                                                    <td
                                                                        :class="[
                                                                            { 'text-secondary': index4 !== 0 }, 
                                                                            { 'text-orange font-weight-bold': index4 === 0 }, 
                                                                            'p-1 text-center'
                                                                        ]"
                                                                    >
                                                                        {{ item4.h_inicio ? horaAMPM(item4.h_inicio) : '' }} 
                                                                        <i :class="[{ 'd-none': index4 !== 0 }, 'fas fa-check']"></i>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                            <tbody v-else>
                                                                <tr>
                                                                    <td :class="[ 'p-1 text-center']">
                                                                    Sin historial
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>

                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div
                                                :class="['btn-group', { 'd-none': item2.fase_ubicacion === 'En espera de clave' }]">
                                                <button
                                                    v-if="!item2.h_fin"
                                                    class="btn-link rounded bg-transparent border-0 text-secondary"
                                                    type="button" id="triggerId" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false"
                                                    style="font-size: 1.2rem;">
                                                    <i class="fas fa-stopwatch text-info"></i> 
                                                    {{
                                                        parseFloat(item2.h_aprox_fin) < 1 
                                                        ? (parseFloat(item2.h_aprox_fin) * 60) + 'min' 
                                                        : item2.h_aprox_fin + ' hora' + (item2.h_aprox_fin > 1 ? 's' : '') 
                                                    }} 
                                                </button>
                                                <div v-else>
                                                    <i class="fas fa-stopwatch text-info"></i> 
                                                    {{
                                                        parseFloat(item2.h_aprox_fin) < 1 
                                                        ? (parseFloat(item2.h_aprox_fin) * 60) + 'min' 
                                                        : item2.h_aprox_fin + ' hora' + (item2.h_aprox_fin > 1 ? 's' : '') 
                                                    }} 
                                                </div>
                                               
                                                 
                                                <div @click="dropdownStop" class="dropdown-menu dropdown-menu-right"
                                                    aria-labelledby="triggerId">
                                                    <div class="dropdown-item">
                                                        <div class="d-flex">
                                                            <select style="width: 110px;"
                                                                :id="'h_aprox_fin_' + item2.id"
                                                                :ref="'h_aprox_fin' + item2.id" type="time"
                                                                class="form-control flex-grow-1" name="h_aprox_fin"
                                                                :data-id_programacion="item2.id"
                                                                v-model="item2.h_aprox_fin"
                                                                @change="handleTiempoProgramacion"
                                                                data-input_name="h_aprox_fin"
                                                                :data-refValue="'h_aprox_fin' + item2.id"
                                                                :data-index="index" :data-index2="index2"
                                                                :data-reservacion_id="item2.id">
                                                                <option value="0.25">15 min</option>
                                                                <option value="0.50">30 min</option>
                                                                <option value="0.75">45 min</option>
                                                                <option v-for="(numero, index) in numeros"
                                                                    :key="'sol_' + index" :value="numero">
                                                                    {{ numero }} hora{{ (numero > 1 ? 's' : '') }}
                                                                </option>
                                                            </select>

                                                            <button @click="handleTiempoProgramacion"
                                                                data-input_name="h_aprox_fin"
                                                                :data-refValue="'h_aprox_fin' + item2.id"
                                                                :data-index="index" :data-index2="index2"
                                                                :data-reservacion_id="item2.id"
                                                                class="ml-1 btn-sm btn btn-outline-success"
                                                                title="Actualizar">&#9998;
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>
                                    </td>
                                    <!-- paciente -->
                                    <td class="p-1">

                                        <div class="d-flex flex-column">
                                            <h4 class="text-secondary text-nowrap">
                                                {{ item2.paciente }}
                                            </h4>
                                            <div class="btn-group p-0 align-self-start ml-1">
                                                <button
                                                    v-if="!item2.h_fin"
                                                    :class="['btn py-0 px-1 rounded ', { 'btn-danger': item2.tipo_reservacion === 'Emergencia', 'btn-warning text-white': item2.tipo_reservacion === 'Electiva' }]"
                                                    type="button" id="triggerId" data-toggle="dropdown"
                                                    :title="item2.tipo_reservacion" aria-haspopup="true"
                                                    aria-expanded="false" style="font-size: 1rem;">
                                                    <div v-if="item2.tipo_reservacion === 'Emergencia'">EMER</div>
                                                    <div v-if="item2.tipo_reservacion === 'Electiva'">ELEC</div>
                                                </button>
                                                <div v-else>
                                                    <div v-if="item2.tipo_reservacion === 'Emergencia'" class="badge badge-danger">EMER</div>
                                                    <div v-if="item2.tipo_reservacion === 'Electiva'" class="badge badge-warning">ELEC</div>
                                                </div>
                                                <div @click="dropdownStop" class="dropdown-menu dropdown-menu-right"
                                                    aria-labelledby="triggerId">
                                                    <div class="dropdown-item">
                                                        <div class="d-flex">
                                                            <select style="width: 110px;"
                                                                :id="'tipo_reservacion_' + item2.id"
                                                                :ref="'tipo_reservacion' + item2.id" type="time"
                                                                class="form-control flex-grow-1" name="tipo_reservacion"
                                                                :data-id_programacion="item2.id"
                                                                v-model="item2.tipo_reservacion"
                                                                @change="handleTipoReservacion"
                                                                data-input_name="tipo_reservacion"
                                                                :data-refValue="'tipo_reservacion' + item2.id"
                                                                :data-index="index" :data-index2="index2"
                                                                :data-reservacion_id="item2.id">
                                                                <option value="Emergencia">Emergencia</option>
                                                                <option value="Electiva">Electiva</option>

                                                            </select>

                                                            <button @click="handleTipoReservacion"
                                                                data-input_name="tipo_reservacion"
                                                                :data-refValue="'tipo_reservacion' + item2.id"
                                                                :data-index="index" :data-index2="index2"
                                                                :data-reservacion_id="item2.id"
                                                                class="ml-1 btn-sm btn btn-outline-success"
                                                                title="Actualizar">&#9998;
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <!-- intervencion -->
                                    <td class="p-1">

                                        <ul v-if="JSON.parse(item2.intervencion).length > 0" style="padding: 5px 20px"
                                            class="mb-0">
                                            <li class="text-secondary d-flex flex-column" :key="'sol4_' + index3"
                                                v-for="(item3, index3) in   JSON.parse(item2.intervencion)">

                                                <div v-if="is_object(item3.description) && item3.hasOwnProperty('description')"
                                                    class="d-flex flex-column">
                                                    <div v-if="item3.hasOwnProperty('description')" class="mb-1">
                                                        {{ item3.description.description }}
                                                    </div>
                                                    <div v-if="item3.hasOwnProperty('description')" class="d-flex mb-1">
                                                        <div v-if="item3.description.codigo" class="badge badge-warning mr-1">
                                                            {{ item3.description.codigo }}</div>
                                                        <div v-if="item3.description.kitsum_asociado" class="badge badge-info mr-1">
                                                            {{ item3.description.kitsum_asociado }}</div>
                                                    </div>
                                                </div>

                                                <div v-if="!is_object(item3.description) && item3.hasOwnProperty('description')"
                                                    class="mb-1">
                                                    {{ item3.description }}
                                                </div>


                                                <div v-if="item3.hasOwnProperty('equipos_especiales') && item3['equipos_especiales'].length > 0"
                                                    class="badge text-left text-dark"
                                                    style="background-color: #8ad3f7;">
                                                    <b>Equipos Especiales:</b>

                                                    <ul class="mt-2 mb-0">
                                                        <li :key="'sol_5' + index4"
                                                            v-for="(item4, index4) in   item3['equipos_especiales']">
                                                            {{ item4.description }}
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>
                                        </ul>
                                    </td>
                                    <!-- cirujanos principales -->
                                    <td class="p-1">

                                        <ul style='padding: 5px 20px' class='mb-0'>

                                            <li class="text-secondary" :key="'sol_6' + index4"
                                                v-for="(item4, index4) in getSetCirujanos(JSON.parse(item2.intervencion))">
                                                {{ item4 }}
                                            </li>
                                        </ul>
                                    </td>
                                    <!-- anestesiologos -->
                                    <td class="p-1">
                                        <TodolistDropdownAnestesiologo 
                                            :solicitud_quirofano_id="item2.id"
                                            :h_fin="item2.h_fin" 
                                            :n_quirofano="item2.n_quirofano" :user_id_paciente="item2.user_id_paciente"
                                            :index="index" :index2="index2" 
                                        />
                                        
                                    </td>
                                    <!-- Personal asistencial -->
                                    <td class="p-1">
                                        
                                        <div class="d-flex flex-column">
                                            <TodolistDropdownWithFilter2 :solicitud_quirofano_id="item2.id"
                                                :index_dia="index" :index_solicitud="index2"
                                                :h_fin="item2.h_fin" 
                                                :n_quirofano="item2.n_quirofano"
                                                :user_id_paciente="item2.user_id_paciente"
                                                :personal_asistencial="item2.personal_asistencial" siglas="CA"
                                                color="success" title="Circulante Anestesia" name="c_anestesia" />
                                            <TodolistDropdownWithFilter2 :solicitud_quirofano_id="item2.id"
                                                :index_dia="index" :index_solicitud="index2"
                                                :h_fin="item2.h_fin" 
                                                :n_quirofano="item2.n_quirofano"
                                                :personal_asistencial="item2.personal_asistencial"
                                                :user_id_paciente="item2.user_id_paciente" siglas="CC" color="primary"
                                                title="Circulante Cirugía" name="c_cirugia" />
                                            <TodolistDropdownWithFilter2 :solicitud_quirofano_id="item2.id"
                                                :index_dia="index" :index_solicitud="index2"
                                                :h_fin="item2.h_fin" 
                                                :n_quirofano="item2.n_quirofano"
                                                :personal_asistencial="item2.personal_asistencial"
                                                :user_id_paciente="item2.user_id_paciente" siglas="IN" color="secondary"
                                                title="Instrumentista" name="instrumentista" />

                                        </div>

                                    </td>
                                    <!-- area intervencion -->
                                    <td class="p-1" style="vertical-align: middle;">
                                        <div class="btn-group">
                                            <button 
                                                v-if="!item2.h_fin"
                                                :class="{
                                                    'text-primary': [422, 418, 420, 421, 425].includes(Number(item2['area_intervencion'])),
                                                    'text-success': [419, 423, 424, 425].includes(Number(item2['area_intervencion'])),
                                                    'text-secondary': ['Domicilio', 'UTIP', 'UTIA', 'UTIN'].includes(item2.area_intervencion),
                                                    'btn-link rounded bg-transparent font-weight-bold border-0': true
                                                }" 
                                                type="button" 
                                                id="triggerId" 
                                                data-toggle="dropdown" 
                                                aria-haspopup="true" 
                                                aria-expanded="false"
                                                style="font-size: 1.2rem;"
                                            >

                                                {{ getUbicacion(item2.area_intervencion) }}
                                            </button>
                                            <div v-else :class="['text-primary', 'text-center font-weight-bold']">
                                                {{ getUbicacion(item2.area_intervencion) }}
                                            </div>
                                            <div @click="dropdownStop" class="dropdown-menu dropdown-menu-right"
                                                aria-labelledby="triggerId">

                                                <div class="dropdown-item">
                                                    <div class="d-flex flex-column">
                                                        <select data-input_name="area_intervencion"
                                                            :data-refValue="'area_intervencion' + item2.id"
                                                            :data-index="index" :data-index2="index2"
                                                            :data-reservacion_id="item2.id"
                                                            :id="'area_intervencion' + item2.id"
                                                            :ref="'area_intervencion' + item2.id"
                                                            @change="handleDestino('area_intervencion' + item2.id)"
                                                            class="form-control form-control-sm rounded-right"
                                                            name="area_intervencion" :data-id_programacion="item2.id"
                                                            v-model="item2.area_intervencion">

                                                            <option :class="{
                                                                    'text-success': [419, 423, 424, 425].includes(Number(ubicacion['id'])),
                                                                    'text-primary': [422, 418, 420, 421, 425].includes(Number(ubicacion['id'])),
                                                                }" 
                                                                v-for="(ubicacion, index) in getUbicacionesOrdenadas([418])" 
                                                                :key="'sol_9' + index"
                                                                :value="ubicacion.id"
                                                            >
                                                                {{ ubicacion.coments }}
                                                            </option>
                                                            <option :class="{
                                                                    'text-success': [419, 423, 424, 425].includes(Number(ubicacion['id'])),
                                                                    'text-primary': [422, 418, 420, 421, 425].includes(Number(ubicacion['id'])),
                                                                }" 
                                                                v-for="(ubicacion, index) in getUbicacionesOrdenadas([422])" :key="'sol_10' + index"
                                                                :value="ubicacion.id">
                                                                Ambulatoria Torre
                                                            </option>
                                                       
                                                        </select>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </td>
                                    <!-- destino -->
                                    <td style="vertical-align: middle;" class="p-1">
                                        <TodoListDestinoHospitalizacion 
                                            :area_intervencion="item2.area_intervencion"
                                            :reservacion_id="item2.id" 
                                            :destino_id="item2.destino" 
                                            :index="index"
                                            :index2="index2" 
                                            :h_fin="item2.h_fin" 
                                            fieldName="destino" 
                                        />

                                       
                                    </td>
                                    <!-- botones opciones -->
                                    <td class="p-1 tbl-row-radius-right">
                                        <div class="d-flex">

                                            <button 
                                                v-if="!item2.h_fin" 
                                                @click="editSolicitud(item2.id)"
                                                class="btn btn-default btn-sm mr-1">
                                                <i class="fas fa-edit text-info"></i>
                                            </button>
                                            <button @click="qxRealizada"
                                                title="Pulsa para indicar si la intervención fue realizada."
                                                :data-index="index" :data-index2="index2"
                                                :data-reservacion_id="item2.id" class="btn btn-default btn-sm mr-1">
                                                <i
                                                    :class="{ 'fas fa-check': true, 'text-purple': item2.h_fin !== null, 'text-secondary': item2.h_fin === null }"></i>
                                            </button>
                                            <button v-if="!item2.h_fin" @click="destroySolicitud" title="Pulsa para eliminar la solicitud"
                                                :data-index="index" :data-index2="index2"
                                                :data-reservacion_id="item2.id" class="btn btn-default btn-sm mr-1">
                                                <i class="far fa-trash-alt text-gray"></i>
                                            </button>
                                            <button @click="finalizarReservacion" title="Finalizar Programación"
                                                :data-index="index" :data-index2="index2"
                                                :data-reservacion_id="item2.id"
                                                class="d-none btn btn-default btn-sm mr-1"><i
                                                    class="fas fa-clipboard-check text-info"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    import { fechaDMA, get, fechaAMD, fechaHoy, meses, post, is_undefined, timestamps, store_field, is_null, is_empty, first, fechaAMD2 } from '../../../../../helpers/customHelpers.js';
    import ColumnaPersonalAsistencial from './ColumnaPersonalAsistencial.vue';
    import TodolistDropdownWithFilter2 from './TodolistDropdownWithFilter2.vue';

    import TodolistDropdownAnestesiologo from './TodolistDropdownAnestesiologo.vue'
    import TodoListDestinoHospitalizacion from './TodolistDestinoHospitalizacion.vue'

    export default {
        components: {
            ColumnaPersonalAsistencial,
            TodolistDropdownWithFilter2,
        
            TodolistDropdownAnestesiologo,
            TodoListDestinoHospitalizacion,
        },
        data() {
            return {
                tempArreglo: [],
                listadoSolicitudesEstaVacio: false,
                listadoSolicitudesEstaCargando: true,
                edad: 0,
                numeros: Array.from({ length: 24 }, (_, index) => index + 1), // Genera un arreglo con números del 1 al 24
            };
        },
        watch: {
            '$route'(to, from) {

                this.getSolicitudesQx()

            }
        },
        methods: {
            haveDestiny(destino_id) {
                let result = this.$store.state['catUbicacion'].find(ubicacion => Number(ubicacion.id) === Number(destino_id))
                if (![undefined, "", null, 'undefined'].includes(result)) {
                    return `${result.description} | ${result.coments}`
                } else {
                    return false
                }
            },
            is_object(item) {

                if (typeof item === "object") {
                    return true
                } else {
                    return false
                }



            },
            getHistorialHorasQx(item2) {
         
                if(
                    !item2['h_real_inicio'] || 
                    !item2['h_inicio']
                ){
                    return []
                }

                let objeto = JSON.parse(item2['h_real_inicio'])
                let objetoOrdenado = []
                if (objeto.length > 0) {
                    objeto.forEach(x => {
                        if(x['h_inicio'] !== null){
                            objetoOrdenado.unshift(x)
                        }
                        
                    })
                    
                } 
                return objetoOrdenado
            },
            getHRealInicio(item2) {
                if(item2['h_real_inicio'] === null && item2['h_inicio'] === null){
                    return []
                }
                let objeto = JSON.parse(item2['h_real_inicio'])
                return objeto[objeto.length - 1]['h_inicio']
            },
            getUbicacionesOrdenadas(id_ubicaciones) {
                let array_filter = id_ubicaciones
                // Objeto de datos
                let data = this.$store.state.catUbicacion.filter(x => array_filter.includes(Number(x['id']))) //418,419,420,421,422,423,424,425

                // Array con el orden deseado
                const orderToArray = array_filter; //,419,,424,425

                // Construir un nuevo objeto ordenado
                const orderedData = [];
                orderToArray.forEach(item => {
                    orderedData.push(data.find(x => x['id'] === item));
                });
                return orderedData
            },
            getUbicacion(id) {
                let result = this.$store.state.catUbicacion.find(x => x['id'] === Number(id))
                return is_undefined(result) ? '' : result.description + " | " + result.coments
            },
            fechaFormat(fecha, divider = "/") {
              

                let nuevaFecha = fecha.split(" ")
                nuevaFecha = nuevaFecha[0].split("-")

                return nuevaFecha[2].toString().padStart(2, '0') + divider + nuevaFecha[1].toString().padStart(2, '0') + divider + nuevaFecha[0]
            },
            editSolicitud(id) {
                this.$store.commit('updateProperty', {
                    fieldName: 'loading',
                    fieldValue: true,
                });
          
                localStorage.setItem("editSolicitud", id)
                this.$store.commit('editSolicitud', id)

                this.$router.push('/areaQuirofano/edit_quirofano')
              
            },
            dropdownStop(e) {
                e.stopPropagation();
                
            },
            getBgColor(id) {
                let model = this.$store.state.personalAsistencial.find(x => x['id'] === id)
                return !is_undefined(model) ? model['backgroundColor'] : 'var(--white)'
            },
            getColor(id) {
                let model = this.$store.state.personalAsistencial.find(x => x['id'] === id)
                return !is_undefined(model) ? model['textColor'] : 'var(--secondary)'
            },
            getSetCirujanos(items) {
                let colection = Array.from(new Set(items.map(x => x.cirujano_principal).flat().map(x => x.description)))

                return colection
            },
            async finalizarReservacion(e) {
        
                let { index, index2, reservacion_id } = e.currentTarget.dataset

                Swal.fire({
                    icon: "warning",
                    title: '¿Deseas finalizar esta solicitud?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: 'Si!, finalizar',
                    denyButtonText: `No!, aún no`,
                }).then(async (result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        this.$store.commit('updateSolicitudQxFinalizar', [index, index2])
                        let result = await get(location.origin + `/areaQuirofano/visibilidadReservacion/${reservacion_id}/3`)
                    }
                })


            },
            async destroySolicitud(e) {

                let { index, index2, reservacion_id } = e.currentTarget.dataset
                let that = this
                Swal.fire({
                    icon: "error",
                    title: '¿Quieres eliminar la solicitud?',
                    html: `
                        Esta acción no se podrá deshacer.

                    `,
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: 'Si!',
                    denyButtonText: `No`,
                    showLoaderOnConfirm: true,

                    allowOutsideClick: () => !Swal.isLoading()
                }).then(async (result) => {

                    if (result.isConfirmed) {
                        let formData = new FormData();
                        formData.append("id", reservacion_id)
                        formData.append("_token", document.querySelector('meta[name="csrf-token"]').getAttribute('content'))

                        let result2 = await post(location.origin + `/areaQuirofano/destroy`, formData)

                        this.$store.commit('deleteSolicitudQx', [index, index2])


                    }

                })





            },
            async qxRealizada(e) {

                let { index, index2, reservacion_id } = e.currentTarget.dataset
                const { 
                    n_quirofano, 
                    fase_ubicacion, 
                    h_inicio,
                    h_real_inicio,
                    intervencion,
                    destino,
                    area_intervencion,
                    personal_asistencial 
                } = this.$store.state.listadoSolicitudesQx[index]['dias'][index2]

                console.log(this.$store.state.listadoSolicitudesQx[index]['dias'][index2]);

                if (![1, 2, 3, 4, 5, 6, 7, 8, 9].includes(n_quirofano)) {
                    Swal.fire({
                        icon: "error",
                        title: "Quirófano requerido",
                        text: "Para finalizar la solicitud es obligatorio haber asignado un Quirófano.",
                    })
                    return false
                }

                if (!['Recuperación', 'Hospitalización', 'UTI', 'Alta'].includes(fase_ubicacion)) {
                    Swal.fire({
                        icon: "error",
                        title: "Fase requerida",
                        text: "Para finalizar la solicitud es obligatorio indicar si el paciente se encuentra en: Recuperación, Hospitalización, UTI, o Alta",
                    })
                    return false
                }

                if (!h_inicio || !h_real_inicio) {
                    Swal.fire({
                        icon: "error",
                        title: "Hora de inicio requerida",
                        text: "Para finalizar la solicitud es obligatorio indicar la hora de inicio de la cirugía.",
                    })
                    return false
                }
                const tempIntervencion = JSON.parse(intervencion)
                if (
                    tempIntervencion.length && 
                    !tempIntervencion[0].description.codigo ||
                    !tempIntervencion[0].description.description
                ) {
                    Swal.fire({
                        icon: "error",
                        title: "Proced y su descripción requeridos",
                        text: "Para finalizar la solicitud es obligatorio haber indicado el código del PROCED y su descripción.",
                    })
                    return false
                }

                if (tempIntervencion.length && !tempIntervencion[0].cirujano_principal.length) {
                    Swal.fire({
                        icon: "error",
                        title: "Cirujano principal requerido",
                        text: "Para finalizar la solicitud es obligatorio haber indicado al menos un Cirujano Principal",
                    })
                    return false
                }

                /* if (tempIntervencion.length && !tempIntervencion[0].anestesiologo.length) {
                    Swal.fire({
                        icon: "error",
                        title: "Anestesiologo requerido",
                        text: "Para finalizar la solicitud es obligatorio haber indicado al menos un Anestesiologo.",
                    })
                    return false
                } */
                console.log(personal_asistencial);
                const canestesia = personal_asistencial.filter(x => x?.tipo_personal === 'c_anestesia')
                if (!canestesia.length) {
                    Swal.fire({
                        icon: "error",
                        title: "Circulante de Anestesia requerido",
                        text: "Para finalizar la solicitud es obligatorio haber asignado un Circulante de Anestesia.",
                    })
                    return false
                }

                const ccirugia = personal_asistencial.filter(x => x?.tipo_personal === 'c_cirugia')
                if (!ccirugia.length) {
                    Swal.fire({
                        icon: "error",
                        title: "Circulante de Cirugía requerido",
                        text: "Para finalizar la solicitud es obligatorio haber asignado un Circulante de Cirugía.",
                    })
                    return false
                }

                const instrumentista = personal_asistencial.filter(x => x?.tipo_personal === 'instrumentista')
                if (!instrumentista.length) {
                    Swal.fire({
                        icon: "error",
                        title: "Instrumentista requerido",
                        text: "Para finalizar la solicitud es obligatorio haber asignado un Instrumentista.",
                    })
                    return false
                }//418 422
                if (
                    [null,'null',undefined,'undefined'].includes(destino) && Number(area_intervencion) !== 422
                ) {
                    Swal.fire({
                        icon: "error",
                        title: "Destino requerido",
                        text: "Para finalizar la solicitud es obligatorio haber indicado el destino.",
                    })
                    return false
                }

                let solicitud = JSON.parse(this.$store.state.listadoSolicitudesQx[index]['dias'][index2]['h_real_inicio'])

                let ultimoRegistro = solicitud[solicitud.length - 1]
                let fecha_cirugia = (ultimoRegistro.h_inicio.split(" "))[0]

                Swal.fire({
                    icon: "warning",
                    title: '¿La cirugía fue realizada?',
                    html: `
                        <label>Si es sí, indica la <b>hora</b> en que finalizó:</label>
                        <div class="d-flex">
                            <input type="date" value="${fecha_cirugia}" class="form-control" id="fecha_fin">
                            <input type="time" class="form-control" id="h_fin">
                        </div>

                    `,
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: 'Si!',
                    denyButtonText: `No`,
                    //showLoaderOnConfirm: true,

                    allowOutsideClick: () => !Swal.isLoading()
                }).then(async (result) => {
                    let input1 = document.getElementById('fecha_fin')
                    let input2 = document.getElementById('h_fin')
                    let fecha_fin = input1.value
                    let h_fin = input2.value
                    if (result.isConfirmed) {
                        // Crear objetos Date a partir de las fechas proporcionadas
                        const date1 = new Date();
                        const date2 = new Date(fecha_cirugia);

                        // Comparar las fechas

                        if (fecha_fin !== fecha_cirugia) {
                            alert("El dia en que se realizó la círugía debe ser el mismo en que fue programada.");
                            return false
                        }

                        //console.log()
                        if (is_empty(input1.value)) {
                            alert("No has indicado la fecha de fin.")
                            input1.focus()
                            fecha_fin = null
                            return false
                        }
                        if (is_empty(input2.value)) {
                            alert("No has indicado la hora de fin.")
                            input2.focus()
                            h_fin = null
                            return false
                        }
                        h_fin = fecha_fin + " " + h_fin

                        this.$store.commit('updateSolicitudQx2', [index, index2, 'h_fin', h_fin])



                    } else if (result.isDenied) {
                        h_fin = ""
                        this.$store.commit('updateSolicitudQx2', [index, index2, 'h_fin', null])

                    }

                    let formData = new FormData();
                    formData.append("id", reservacion_id)
                    formData.append("field", 'h_fin')
                    formData.append("value", h_fin)
                    formData.append("_token", document.querySelector('meta[name="csrf-token"]').getAttribute('content'))

                    let result2 = await post(location.origin + `/areaQuirofano/update`, formData)

                    this.handleRegProgramacion(
                        '¿Deseas reubicar al paciente?',
                        'fase_ubicacion',
                        'Recuperación',
                        reservacion_id,
                        index2,
                        index
                    )
                    // console.log(result2)
                })





            },
            horaAMPM(h_inicio) {

                let h = h_inicio.split(" ")
                let fullHora = h[1].split(":")

                let hora = fullHora[0];
                let minutos = fullHora[1];

                let horario = "AM"
                if (parseInt(hora) >= 12 && parseInt(hora) <= 23) {
                    horario = "PM"
                }
                switch (hora) {
                    case "13": hora = 1; break
                    case "14": hora = 2; break
                    case "15": hora = 3; break
                    case "16": hora = 4; break
                    case "17": hora = 5; break
                    case "18": hora = 6; break
                    case "19": hora = 7; break
                    case "20": hora = 8; break
                    case "21": hora = 9; break
                    case "22": hora = 10; break
                    case "23": hora = 11; break
                    case "00": hora = 12; break
                }

                return `${String(hora).padStart(2, '0')}:${String(minutos).padStart(2, '0')} ${horario}`
            },
            horaAMPM2(param) {
                //let m = "AM"

                let p = param.split(" ")
                p = p[1].split(":")

                return `${p[0].padStart(2, '0')}:${p[1].padStart(2, '0')}`


            },
            getTime(param) {
                let hoy = new Date(param);
                //console.log(hoy)
                return hoy.getHours() + ":" + hoy.getMinutes()
            },
            async handleRegProgramacion(message, field, value, id, index, index2) {

                let formData = new FormData();
                formData.append("id", id)
                formData.append("field", field)
                formData.append("value", value)
                formData.append("_token", document.querySelector('meta[name="csrf-token"]').getAttribute('content'))

                let result2 = await post(location.origin + `/areaQuirofano/update`, formData)

                this.$store.commit('updateSolicitudQx2', [index2, index, field, value])


                if (field == "fecha_reservacion") {
                    let h_aprox_fin = (document.querySelector(`#fecha_reservacion_${id}`).dataset.h_aprox_fin).split(" ")
                    formData = new FormData();
                    formData.append("id", id)
                    formData.append("field", "h_aprox_fin")
                    formData.append("value", value + " " + h_aprox_fin[1])
                    formData.append("_token", document.querySelector('meta[name="csrf-token"]').getAttribute('content'))
                    result2 = await post(location.origin + `/areaQuirofano/update`, formData)



                    let hora = document.querySelector(`#h_real_inicio_${id}`).value
                    formData = new FormData();
                    formData.append("id", id)
                    formData.append("field", "h_inicio")
                    formData.append("value", value + " " + hora)
                    formData.append("_token", document.querySelector('meta[name="csrf-token"]').getAttribute('content'))
                    result2 = await post(location.origin + `/areaQuirofano/update`, formData)



                }
                //actualizar en la vista la fecha
                await this.getSolicitudesQx()
                if ([].includes(field)) {
                    Swal.fire({
                        icon: "success",
                        title: "Programación actualizada",
                        text: "Los datos de la solicitud han sido actualizados correctamente.",

                    })
                }


            },
            async getSolicitudesQx() {
                try {

                    let model
                    let [startDate, endDate] = this.$store.state.rango
                    this.$store.commit('updateProperty', {
                        fieldName: 'loading',
                        fieldValue: true,
                    });
                    if (this.$route.path == "/areaQuirofano/index_quirofano") {
                        model = await get(location.origin + `/areaQuirofano/cupo/getAllInterno?startDate=${fechaAMD2(this.$store.state.fechadesde)}&endDate=${fechaAMD2(this.$store.state.fechahasta)}&area_intervencion=hospitalizacion`)
                    } else {
                        model = await get(location.origin + `/areaQuirofano/cupo/getAllFinalizadas?startDate=${fechaAMD2(startDate)}&endDate=${fechaAMD2(endDate)}&area_intervencion=hospitalizacion`)
                    }
                    this.$store.commit('updateProperty', {
                        fieldName: 'loading',
                        fieldValue: false,
                    });
                    if (model.length === 0) {
                        this.listadoSolicitudesEstaVacio = true
                    } else {
                        this.listadoSolicitudesEstaVacio = false
                    }
                    let solicitudesPorDia = []

                    //obtenemos las fechas unicas
                    let fechas_unicas = Array.from(new Set( model.filter(item => item['fecha_reservacion'] !== null).map(item => {
                        let h_inicio = item['fecha_reservacion'].split(" ")
                        return h_inicio[0]
                    })))
                        //eliminamos los valores null
                        .filter(item => item !== null)

                    if (!fechas_unicas.length) {
                        fechas_unicas = Array.from(new Set( model.filter(item => item['fecha_reservacion'] !== null).map(item => {
                            return item.fecha_reservacion
                        })))
                    }

                    //convertimos las fechas a milisegunsos para luego poderlas ordenar
                    fechas_unicas = fechas_unicas.map(item => {
                        let fecha = new Date(item)
                        return { "milisegundos": fecha.getTime(), "original": item }
                    })
                    //las ordenamos
                    if (this.$route.path == "/areaQuirofano/index_quirofano") {
                        fechas_unicas = fechas_unicas.sort((a, b) => a.milisegundos - b.milisegundos)
                    } else {
                        fechas_unicas = fechas_unicas.sort((a, b) => b.milisegundos - a.milisegundos)
                    }
                    //asignamos las solicitudes organizandolas por las fechas unicas 
                    fechas_unicas.forEach(item => {
                        solicitudesPorDia.push({
                            fecha: item.original,
                            dias: model.filter(item2 => {
                                if (item2['fecha_reservacion'] === item.original) {
                                    return item2
                                }

                            })
                        })
                        
                    }) 

                    this.$store.commit('updateListadoSolicitudesQx', solicitudesPorDia)
                } catch (error) {
                    console.error('Error al obtener los datos:', error);
                    return []
                }
            },
            isSelected(param) {
                if (param !== null) {
                    let option = JSON.parse(param)
                
                    return Number(option.id)
                    
                }
                return 0

            },
            async handleFaseUbicacion(e) {
                let button = e.target
                let { input_name, input_value, reservacion_id, index, index2 } = button.dataset

                this.handleRegProgramacion(
                    '¿Deseas reubicar al paciente?',
                    input_name,
                    input_value,
                    reservacion_id,
                    index2,
                    index
                )

            },
            async handlehoraProgramacion(e) {
                let tag = e.target
                let input_value
                if (e.target.tagName === "BUTTON") {
                    input_value = tag.previousElementSibling.value
                }
                if (e.target.tagName === "INPUT") {
                    input_value = tag.value
                }
                if (input_value === "") {
                    alert("Ingrese la hora")
                    return false
                }
          
                //let button = e.target
                //let input_value = button.previousElementSibling.value
                let { input_name, reservacion_id, index, index2 } = tag.dataset
                let fecha = document.querySelector(`#fecha_reservacion_${reservacion_id}`).value


                let h_real_inicio = !this.$store.state.listadoSolicitudesQx[index]['dias'][index2]['h_inicio'] && 
                    !this.$store.state.listadoSolicitudesQx[index]['dias'][index2]['h_real_inicio']

                    ? [
                        {
                            "id":1,
                            "h_inicio":fecha +" "+ input_value,
                            "description":"",
                            "user_id":this.$store.state.userData.user_id_medico,
                            "created_at":timestamps()
                        }
                    ]
                    : JSON.parse(this.$store.state.listadoSolicitudesQx[index]['dias'][index2]['h_real_inicio'])
                
                if(
                    this.$store.state.listadoSolicitudesQx[index]['dias'][index2]['h_inicio'] && 
                    this.$store.state.listadoSolicitudesQx[index]['dias'][index2]['h_real_inicio']
                ){
                    let newObject = { 
                            "id": (first(h_real_inicio)['id'] + 1), 
                            "h_inicio": fecha + " " + input_value, 
                            "description": "", 
                            "user_id": this.$store.state.userData.user_id_medico, 
                            "created_at": timestamps() 
                        }
                    h_real_inicio.push(newObject)
                }
                

                
                this.$store.commit('updateProperty', {
                    fieldName: 'loading',
                    fieldValue: true,
                });
                let formData = new FormData();
                formData.append("id", reservacion_id)
                formData.append("field", 'h_real_inicio')
                formData.append("value", JSON.stringify(h_real_inicio))
                formData.append("_token", document.querySelector('meta[name="csrf-token"]').getAttribute('content'))

                let result2 = await post(location.origin + `/areaQuirofano/update`, formData)

                await this.getSolicitudesQx()
                this.$store.commit('updateProperty', {
                    fieldName: 'loading',
                    fieldValue: false,
                });
           

                this.$store.commit('updateSolicitudQx2', [index2, index, "h_real_inicio", JSON.stringify(h_real_inicio)])


     

            },
            async handleTiempoProgramacion(e) {
                let tag = e.target

                let { input_name, reservacion_id, index, index2 } = tag.dataset
                let tiempo = document.querySelector(`#h_aprox_fin_${reservacion_id}`).value

                this.handleRegProgramacion(
                    '¿Deseas actualizar el tiempo de la intervención?',
                    input_name,
                    tiempo,
                    reservacion_id,
                    index2,
                    index
                )
                //tipo_reservacion
            },
            async handleTipoReservacion(e) {
                let tag = e.target

                let { input_name, reservacion_id, index, index2 } = tag.dataset
                let input_value = document.querySelector(`#${input_name + '_' + reservacion_id}`).value

                this.handleRegProgramacion(
                    '¿Deseas actualizar el tipo de reservación?',
                    input_name,
                    input_value,
                    reservacion_id,
                    index2,
                    index
                )

            },
            async handlePersonalAsistencial(e) {
                let button = e.target
                let { input_name, reservacion_id, index, index2 } = button.dataset
                let input_value = document.querySelector(`#${input_name + reservacion_id}`)
                let selectedOption = input_value.options[input_value.selectedIndex];

                let temp_object = {
                    "id": selectedOption.value,
                    "description": selectedOption.text,
                }
                this.handleRegProgramacion(
                    '¿Deseas actualizar el personal asistencial?',
                    input_name,
                    JSON.stringify(temp_object),
                    reservacion_id,
                    index2,
                    index
                )

            },

            async handleDestino(indexDestino) {


                let select = document.querySelector(`#${indexDestino}`)
                let { input_name, reservacion_id, index, index2 } = select.dataset
                let input_value = select.value
      
                let formData = new FormData();
                formData.append("id", reservacion_id)
                formData.append("field", input_name)
                formData.append("value", input_value)
                formData.append("_token", document.querySelector('meta[name="csrf-token"]').getAttribute('content'))

                let result2 = await post(location.origin + `/areaQuirofano/update`, formData)

                this.$store.commit('updateSolicitudQx2', [index2, index, 0, input_value])



                //actualizar en la vista la fecha
                await this.getSolicitudesQx()
                /* if ([].includes(field)) {
                    Swal.fire({
                        icon: "success",
                        title: "Programación actualizada",
                        text: "Los datos de la solicitud han sido actualizados correctamente.",

                    })
                } */

            },
            async handleFechaProgramacion(e) {

                let tag = e.target
                let input_value
                if (e.target.tagName === "BUTTON") {
                    input_value = tag.previousElementSibling.value
                }
                if (e.target.tagName === "INPUT") {
                    input_value = tag.value
                }
                let { input_name, reservacion_id, index, index2 } = tag.dataset
                let hora = document.querySelector(`#h_real_inicio_${reservacion_id}`).value

                this.handleRegProgramacion(
                    '¿Deseas reprogramar la fecha de la intervención?',
                    input_name,
                    input_value + " " + hora,
                    reservacion_id,
                    index2,
                    index
                )

            },
            formatTabFecha(fecha) {
              
                let date = fecha.split("-")
                return [
                    date[0],
                    meses(Number(date[1]) - 1).slice(0, 3).toUpperCase(),
                    date[2],
                ]
            },
            mostrarSolicitud(fechaGrupo, fechaSolicitud) {
               
                if (fechaGrupo === fechaAMD(fechaSolicitud)) {
                    return true
                } else {
                    return false
                }
            },
            handle_is_null(data) {
                return is_null(data)
            },
            async getPersonalAsistencial() {

                try {
                    this.listadoQuirofanoEstaCargando = true
                    let model = await get(location.origin + '/areaQuirofano/personal_asistencial/gelAll')

                    this.$store.commit('updatePersonalAsistencial', model)

                    model = await get(location.origin + '/areaQuirofano/personal_asistencial/gelAllOtroPersonal')
                    this.$store.commit('updateOtroPersonalAsistencial', model)


                    this.listadoQuirofanoEstaCargando = false
                } catch (error) {
                    this.listadoQuirofanoEstaCargando = false
                    console.error('Error al obtener los datos:', error);
                    return []
                }
            },
        },
        computed: {

            existenSolicitudesQx() {
                let result = this.$store.state.listadoSolicitudesQx
            
                if (result.length === 0) {
                    this.listadoSolicitudesEstaVacio = true
                } else {
                    this.listadoSolicitudesEstaVacio = false
                }
                return result
            },
            listadoSolicitudesQx() {
             
                return this.$store.state.listadoSolicitudesQx.sort((a, b) => a['n_quirofano'] - b['n_quirofano']);
            }
        },
        created() {
            const startDate = new Date();
            const endDate = new Date(new Date().setDate(startDate.getDate() + 1));
            let rango = [fechaAMD2(startDate), fechaAMD2(endDate)];

            this.$store.commit('updateProperty', {
                fieldName: 'rango',
                fieldValue: rango,
            });
        },
        mounted: async function () {


            this.listadoSolicitudesEstaCargando = true
            await this.getPersonalAsistencial()
            await this.getSolicitudesQx()
            this.listadoSolicitudesEstaCargando = false

        },
    }
</script>

<style lang="scss" scoped>
    .cursor-pointer {
        cursor: pointer !important;
    }

    table {
        border-collapse: collapse !important;
        border-spacing: 0px 10px !important;
    }

    button.btn-link:hover,
    .btn-link:hover {
        background-color: rgb(236, 236, 236) !important;
    }

    .bg-preanestesia {
        background-color: #f2ffa9;

    }

    .bg-clave-espera {
        background-color: #eb8c3f;

    }

    .bg-quirofano {
        background-color: #a9e2ff;

    }

    .bg-recuperacion {
        background-color: #dcffc8;
    }

    .bg-hospitalizacion {
        background-color: #cbe3ff;
    }

    .bg-uti {
        background-color: #e1cc8c;
    }

    .bg-alta {
        background-color: #eadfff;
    }


    .blink-2 {
        -webkit-animation: blink-2 .9s infinite both;
        animation: blink-2 .9s infinite both
    }

    @-webkit-keyframes blink-2 {
        0% {
            opacity: 1
        }

        50% {
            opacity: .2
        }

        100% {
            opacity: 1
        }
    }

    @keyframes blink-2 {
        0% {
            opacity: 1
        }

        50% {
            opacity: .2
        }

        100% {
            opacity: 1
        }
    }
</style>
