<template>
    <main class="flex-fill container-fluid d-flex flex-column overflow-auto">
        <div id="carouselExampleIndicators" class="flex-fill carousel slide  carousel-fade d-flex flex-column"
            data-interval="10000" data-ride="carousel">

            <ol class="carousel-indicators">
                <li v-for="(item,index) in getPagesCarausel()" :key="item.id" data-target="#carouselExampleIndicators"
                    :data-slide-to="index" :class="{'active':index===0}">
                </li>
            </ol>
            <div class="flex-fill d-flex carousel-inner">
                <div v-for="(item,index) in getPagesCarausel()" :key="item.id" data-target="#carouselExampleIndicators"
                    :data-slide-to="index" :class="['carousel-item',{'active':index===0}]">

                    <div class="row d-flex flex-column overflow-auto">

                        <div class="col-12">
                            <table>
                                <thead>
                                    <tr class="text-center text-white shadow-sm">
                                        <th class=" sticky-top text-uppercase  corner-radius-bottom-left">Qx
                                        </th>
                                        <th class=" sticky-top text-uppercase ">Datos del Paciente</th>
                                        <th class=" sticky-top text-nowrap text-uppercase ">Hora Inicio IQX
                                        </th>
                                        <th class=" sticky-top text-uppercase ">Horas QX</th>
                                        <th class=" sticky-top text-uppercase ">Intervención</th>
                                        <th class=" sticky-top text-uppercase ">Cirujano Principal</th>
                                        <th class=" sticky-top text-uppercase ">Anestesiólogo</th>
                                        <th class=" sticky-top text-uppercase ">Personal Asistencial</th>
                                        <th class=" sticky-top text-uppercase ">Equipos Especiales</th>
                                        <th class=" sticky-top text-uppercase ">Área IQX</th>
                                       <!--  <th class=" sticky-top text-uppercase  corner-radius-bottom-right">
                                            Destino</th> -->
                                    </tr>

                                </thead>
                                <tbody>
                                    <tr v-for="(solicitud, index) in item" :key="index"
                                        :class="['glassmod-effect swing-in-top-fwd shadow-sm']">

                                        <!-- QX -->
                                        <td class="tbl-row-radius-left py-0 text-center text-white p-1">

                                            <h3 class="mb-0" :style="{'color':'white'}">QX{{solicitud['n_quirofano']}}
                                            </h3>

                                            <div :class="{'flex-column h5 mb-0 text-clave-espera d-none':true,'d-flex':solicitud.fase_ubicacion==='En espera de clave'}"
                                                style="font-size: 1rem;border-radius: 5px;padding: 0.2rem;">
                                                <div class="text-nowrap"><i
                                                        :class="{'fas fa-key':true,'d-none': false}"></i> En espera de
                                                    clave</div>

                                            </div>
                                            <div :class="{'flex-column h5 mb-0 text-preanestesia d-none':true,'d-flex':solicitud.fase_ubicacion==='Pre-anestesia'}"
                                                style="font-size: 1rem;border-radius: 5px;padding: 0.2rem;">
                                                <div class="text-nowrap"><i
                                                        :class="{'fas fa-syringe':true,'d-none': false}"></i>
                                                    Pre-anestesia</div>

                                            </div>
                                            <div :class="{'flex-column blink-2 h5 mb-0 text-quirofano d-none':true,'d-flex':solicitud.fase_ubicacion==='En quirófano'}"
                                                style="font-size: 1rem;border-radius: 5px;padding: 0.2rem;">
                                                <div class="text-nowrap"><i
                                                        :class="{'pc-cirugia':true,'d-none': false}"></i> En Quirófano
                                                </div>

                                            </div>
                                            <div :class="{'flex-column h5 mb-0 text-recuperacion d-none':true,'d-flex':solicitud.fase_ubicacion==='Recuperación'}"
                                                style="font-size: 1rem;border-radius: 5px;padding: 0.2rem;">
                                                <div class="text-nowrap"><i
                                                        :class="{'fas fa-check':true,'d-none': false}"></i> En
                                                    Recuperación</div>

                                            </div>
                                            <div :class="{'flex-column h5 mb-0 text-hospitalizacion d-none':true,'d-flex':solicitud.fase_ubicacion==='Hospitalización'}"
                                                style="font-size: 1rem;border-radius: 5px;padding: 0.2rem;">
                                                <div class="text-nowrap"><i
                                                        :class="{'pc-light-pisos':true,'d-none': false}"></i>
                                                    Hospitalización</div>

                                            </div>
                                            <div :class="{'flex-column h5 mb-0 text-uti d-none':true,'d-flex':solicitud.fase_ubicacion==='UTI'}"
                                                style="font-size: 1rem;border-radius: 5px;padding: 0.2rem;">
                                                <div class="text-nowrap"><i
                                                        :class="{'pc-uti-light':true,'d-none': false}"></i> UTI</div>

                                            </div>
                                            <div :class="{'flex-column h5 mb-0 text-alta d-none':true,'d-flex':solicitud.fase_ubicacion==='Alta'}"
                                                style="font-size: 1rem;border-radius: 5px;padding: 0.2rem;">
                                                <div class="text-nowrap"><i
                                                        :class="{'pc-check':true,'d-none': false}"></i> Alta</div>

                                            </div>
                                            <div :class="{'flex-column h5 text-white d-none':true,'d-flex':solicitud.fase_ubicacion==='Suspendida'}"
                                                style="font-size: 1rem;border-radius: 5px;padding: 0.2rem;">
                                                <div class="text-nowrap"><i :class="{'fas fa-check':true}"></i>
                                                    Suspendida</div>

                                            </div>


                                        </td>
                                        <!-- paciente -->
                                        <td class="text-center py-0  text-white">
                                            <div class="d-flex w-100 ">
                                                <h5 class="text-nowrap mb-0">{{solicitud['paciente']}}</h5>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <div
                                                    :class="[(solicitud['genero'] =='f'?'badge-pink':'badge-primary'),'badge mb-1 d-flex align-items-center px-2 mr-2 text-uppercase']"
                                                    style="font-size: 0.6rem; padding: 0.1rem;"
                                                >
                                                    <i class="fas fa-venus-mars mr-2"></i>
                                                    <span style="font-size: 0.9rem; font-weight: 500;">{{solicitud['genero']}}</span>
                                                </div>
                                                <div class="badge mb-1 d-flex align-items-center px-2 badge-warning mr-2"
                                                    style="font-size: 0.6rem; padding: 0.1rem;"><i
                                                        class="fas fa-birthday-cake mr-2"></i> <span
                                                        style="font-size: 0.9rem; font-weight: 500;">{{ solicitud['edad'] }} A</span>
                                                </div>
                                                <div title="Emergencia"
                                                    :class="{'badge mb-1 badge-danger text-left text-white d-none':true, 'd-block':solicitud['tipo_reservacion']=='Emergencia' }">
                                                    EMER
                                                </div>
                                                <div title="Electiva"
                                                    :class="{'badge mb-1 badge-warning  text-left text-white d-none':true, 'd-block':solicitud['tipo_reservacion']=='Electiva' }">
                                                    ELEC
                                                </div>
                                            </div>
                                            <!-- <div class="d-flex flex-column text-nowrap">
                                                <div class="d-flex">
                                                    <b class="mr-2">Edad:</b>
                                                    <div>{{solicitud['edad']}}</div>
                                                </div>
                                                <div class="d-flex">
                                                    <b class="mr-2">CI:</b>
                                                    <div>{{solicitud['cedula']}}</div>
                                                </div>
                                            </div> -->

                                        </td>
                                        <!-- Hora de inicio -->
                                        <td class="text-center py-0  text-white">
                                            <div :class="['text-center text-nowrap align-items-center',{'d-none':solicitud.fase_ubicacion==='En espera de clave' || getHistorialHorasQx(solicitud).length > 1},{'d-flex':solicitud.fase_ubicacion!=='En espera de clave' && getHistorialHorasQx(solicitud).length === 1}]"
                                                title="Hora pautada de inicio">
                                                <i class="fas fa-clock mr-1"></i>
                                                {{get_hora_inicio(solicitud['h_inicio'])}}
                                            </div>
                                            <div :class="[{'d-none':getHistorialHorasQx(solicitud).length === 1 || solicitud.fase_ubicacion==='En espera de clave'}, 'text-center text-nowrap align-items-center']"
                                                title="Hora real de inicio">
                                                <i class="pc-clock-update mr-1"></i> {{ horaAMPM(
                                                JSON.parse(solicitud['h_real_inicio'])[JSON.parse(solicitud['h_real_inicio']).length
                                                - 1]['h_inicio'] )}}
                                            </div>
                                        </td>
                                        <!-- Horas de QX -->
                                        <td class="text-center py-0  text-white">

                                            <div
                                                :class="['flex-column',{'d-none':solicitud.fase_ubicacion==='En espera de clave'},{'d-flex':solicitud.fase_ubicacion!=='En espera de clave'}]">
                                                <div class="text-nowrap">
                                                    {{solicitud['horas_intervencion']}} - <span>({{
                                                        getTiempoCirugiaQx(solicitud)['hora_estimada_fin'] }})</span>
                                                </div>

                                                <div v-if="solicitud['h_fin'] === null && solicitud['fase_ubicacion']==='En quirófano'"
                                                    class="d-flex justify-content-center p-1 badge badge-info"
                                                    title="Tiempo actual de la IQX">
                                                    <i class="blink-2 pc-cronometro-light mr-1 h6 mb-0"></i>
                                                    <div class="h6 mb-0">{{
                                                        getTiempoCirugiaQx(solicitud)['duracion_total_iqx']}} </div>
                                                </div>
                                                <div v-if="solicitud['h_fin'] !== null && solicitud['fase_ubicacion']!=='En quirófano'"
                                                    class="d-flex flex-column justify-content-start p-1"
                                                    style="background-color: #8e00ff47 !important;font-size: 1rem;border-radius: 5px;padding: 0.1rem;"
                                                    title="Tiempo de duración de la IQX">
                                                    <div class="font-weight-normal">
                                                        <i class="fas fa-check-double mr-1 h6 mb-0"></i>Fín: {{
                                                        horaAMPM(solicitud.h_fin) }}
                                                    </div>
                                                    <div class="h6 mb-0">
                                                        <i class="pc-cronometro-light mr-1 h6 mb-0"></i>Duración: {{
                                                        getTiempoCirugia(solicitud)['duracion_total_iqx']}}
                                                    </div>
                                                </div>
                                            </div>

                                            <span :id="'solicitud_'+solicitud['id']"></span>

                                        </td>
                                        <!-- intervencion -->
                                        <td class="text-white py-0 ">
                                            <!--  <ul style='padding: 5px 20px'>
                                                <li v-for="(item, index) in get_json(solicitud['intervencion'])" :key="index">{{item.description}}</li>

                                            </ul> -->
                                            <ul v-if="JSON.parse(solicitud.intervencion).length > 0"
                                                style="padding: 5px 20px" class="mb-0">
                                                <li
                                                    class="d-flex flex-column"
                                                    :key="index3"
                                                    style="font-size:0.9rem"
                                                    v-for="(item3,index3) in   JSON.parse(solicitud.intervencion)">

                                                    <div v-if="is_object(item3.description) && item3.hasOwnProperty('description')"
                                                        class="d-flex flex-column">
                                                        <div v-if="item3.hasOwnProperty('description')" class="mb-1">
                                                            {{item3.description.description}}
                                                        </div>
                                                        <div v-if="item3.hasOwnProperty('description')"
                                                            class="d-flex mb-1">
                                                            <div v-if="item3.description.codigo !== ''" class="badge badge-warning mr-1">
                                                                {{item3.description.codigo}}</div>
                                                            <div v-if="item3.description.kitsum_asociado !== ''" class="badge badge-info mr-1">
                                                                {{item3.description.kitsum_asociado}}</div>
                                                        </div>
                                                    </div>

                                                    <div v-if="!is_object(item3.description) && item3.hasOwnProperty('description')"
                                                        >
                                                        {{item3.description}}
                                                    </div>


                                                    <!-- <div v-if="item3.hasOwnProperty('equipos_especiales') && item3['equipos_especiales'].length > 0" class="badge text-left text-dark" style="background-color: #8ad3f7;">
                                                        <b >Equipos Especiales:</b>

                                                        <ul class="mt-2 mb-0">
                                                            <li :key="index4" v-for="(item4,index4) in   item3['equipos_especiales']">
                                                                {{item4.description}}
                                                            </li>
                                                        </ul>
                                                    </div> -->
                                                </li>
                                            </ul>
                                        </td>
                                        <!-- cirujano principal -->
                                        <td class=" text-white py-0 ">

                                            <ul

                                                class="list-group mt-1 list-group-flush"
                                            >
                                                <li
                                                    v-for="(item4,index4) in getSetCirujanos( JSON.parse(solicitud.intervencion) )"
                                                    :key="index4"
                                                    class="list-group-item border-0 bg-transparent p-0" style="font-size:0.9rem"
                                                >
                                                    <div class="d-flex align-items-center">
                                                        <img

                                                            loading="lazy"
                                                            onerror="this.src='/image/system/patient.svg'"
                                                            :src="getImagen(item4)"
                                                            class="img-doctor mr-1"
                                                            style="width: 35px; height: 35px; border-radius: 20px;"
                                                        >
                                                        <div class="d-flex flex-column">
                                                            <div>
                                                                {{formatearNombrePaciente(item4)}}
                                                            </div>
                                                            <span class="badge mb-1 badge-primary font-weight-normal">
                                                                {{ getSetEspecialidad(item4.id) }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>

                                        </td>
                                        <!-- anestesiologo -->
                                        <td class=" text-white py-0 ">
                                            <div v-if="JSON.parse(solicitud.intervencion).length > 0">
                                                <ul
                                                    v-for="(item3,index3) in JSON.parse(solicitud.intervencion)"
                                                    :key="index3"
                                                    class="list-group list-group-flush"
                                                >
                                                    <li
                                                        v-for="(item4,index4) in   item3['anestesiologo']"
                                                        :key="index4"
                                                        class="list-group-item border-0 bg-transparent p-0"
                                                        style="font-size:0.9rem"
                                                    >
                                                        <div class="d-flex">
                                                            <img

                                                                loading="lazy"
                                                                onerror="this.src='/image/system/patient.svg'"
                                                                :src="getImagen(item4)"
                                                                class="img-doctor mr-1"
                                                                :style="getSetCirujanos( JSON.parse(solicitud.intervencion) ).length === 1 ? 'width: 35px; height: 35px; border-radius: 20px;' : 'width: 15px; height: 15px; border-radius: 20px;'"
                                                            >
                                                            <div class="d-flex  mb-1 flex-column">
                                                                <div>
                                                                    {{formatearNombrePaciente(item4)}}
                                                                </div>
                                                                <span class="badge badge-primary font-weight-normal">
                                                                    {{ getSetEspecialidad(item4.id) }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>




                                            </div>
                                        </td>
                                        <!-- personal asistencial -->
                                        <td class="text-white py-0 ">
                                            <TodolistDropdownCirculanteAnestesia :solicitud="solicitud"
                                                :solicitud_quirofano_id="solicitud.id"
                                                :n_quirofano="solicitud.n_quirofano"
                                                :user_id_paciente="solicitud.user_id_paciente" />
                                            <TodolistDropdownCirculanteCirugia :solicitud_quirofano_id="solicitud.id"
                                                :solicitud="solicitud" :n_quirofano="solicitud.n_quirofano"
                                                :user_id_paciente="solicitud.user_id_paciente" />
                                            <TodolistDropdownInstrumentista :solicitud_quirofano_id="solicitud.id"
                                                :solicitud="solicitud" :n_quirofano="solicitud.n_quirofano"
                                                :user_id_paciente="solicitud.user_id_paciente" />
                                        </td>
                                        <!-- equipos especiales -->
                                        <td class=" text-white py-0 ">
                                            <ul
                                                v-for="(item3,index3) in JSON.parse(solicitud.intervencion)"
                                                :key="index3"
                                                class="list-group list-group-flush"
                                            >
                                                <li
                                                    v-for="(item4,index4) in   item3['equipos_especiales']"
                                                    :key="index4"
                                                    class="list-group-item bg-transparent p-0" style="font-size:0.9rem"
                                                >
                                                    {{item4.description}}
                                                </li>

                                            </ul>

                                        </td>
                                        <!-- area iqx -->
                                        <td :class="{
                                            'tbl-row-radius-right py-0  text-white  p-1':true,
                                            'text-primary':Number(solicitud.destino) === 418,
                                            'text-success':Number(solicitud.destino) === 419,

                                        }">

                                            {{solicitud['area_intervencion']===null || [
                                            418, //Hospitalizacion
                                            //420, //Electiva
                                            //421, //Emergencia
                                            419,// Ambulatoria
                                            //422,// Torre
                                            423,// MAPM
                                            //424,// Oftalmologica
                                            //425 // Especialidades
                                            ].includes(Number(solicitud.area_intervencion)) ?'':
                                            getUbicacion(solicitud.area_intervencion) }}
                                        </td>
                                        <!-- destino -->
                                       <!--  <td class="text-white py-0  tbl-row-radius-right">
                                            {{solicitud['destino']===null ?'': getUbicacion(solicitud.destino) }}
                                        </td> -->

                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>


                <!-- <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a> -->
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <table id="table3">
                        <thead>
                            <tr>
                                <th
                                    class="text-white sticky-top text-center text-uppercase shadow-1 tbl-row-radius-left">
                                    <i class="pc-medico"></i> PRE-ANESTESIA
                                </th>
                                <th class="text-white sticky-top text-center text-uppercase shadow-1">
                                    <i class="pc-medico"></i> RECUPERACIÓN
                                </th>
                                <th
                                    class="text-white sticky-top text-center text-uppercase shadow-1 tbl-row-radius-right">
                                    <i class="pc-medico"></i> PRE Y POST OBSTÉTRICO / PEDIATRÍA
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="glassmod-effect swing-in-top-fwd shadow-sm">
                                <td style="vertical-align:middle;color:${row['backgroundColor']};"
                                    class="tbl-row-radius-left text-center  text-white shadow-1 p-1">
                                    <ul class="list-group list-group-flush p-0">
                                        <li v-for="(x, index) in getOtroPersonalAsistencial('preanestesia')"
                                            :key="index"
                                            class="list-group-item bg-transparent d-flex justify-content-between align-items-center p-0">
                                            <div>{{x['personal']}} </div>
                                        </li>
                                    </ul>

                                </td>
                                <td class="text-white shadow-1 p-1" style="vertical-align:middle;">
                                    <ul class="list-group list-group-flush p-0">
                                        <li v-for="(x, index) in getOtroPersonalAsistencial('recuperacion')"
                                            :key="index"
                                            class="list-group-item bg-transparent d-flex justify-content-between align-items-center p-0">
                                            <div>{{x['personal']}} </div>
                                        </li>
                                    </ul>
                                </td>
                                <td class=" text-white shadow-1 p-1  tbl-row-radius-right"
                                    style="vertical-align:middle;">
                                    <ul class="list-group list-group-flush p-0">
                                        <li v-for="(x, index) in getOtroPersonalAsistencial('obstetrico')" :key="index"
                                            class="list-group-item bg-transparent d-flex justify-content-between align-items-center p-0">
                                            <div>{{x['personal']}} </div>
                                        </li>
                                    </ul>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
    import { get,timestamps, fechaHoy,formatFecha,is_null,relog,horaPm,formatAMPM,mesesEnEspanol,is_undefined } from '../../../../helpers/customHelpers';
    import TodolistDropdownInstrumentista from './TodolistDropdownInstrumentista.vue'
    import TodolistDropdownCirculanteCirugia from './TodolistDropdownCirculanteCirugia.vue'
    import TodolistDropdownCirculanteAnestesia from './TodolistDropdownCirculanteAnestesia.vue'


    export default {
        components:{
            TodolistDropdownInstrumentista,
            TodolistDropdownCirculanteCirugia,
            TodolistDropdownCirculanteAnestesia,

        },
        data() {
            return {
                cronometros:[]
            }
        },
        computed:{

        },
        methods: {
            formatearNombrePaciente(item){
                let medico = this.$store.state.listadoEquipoCirugia.find(x=>x.user_id===item.id)
                    console.log("--->",medico);
                let temp_nombres = ""
                    if(!is_undefined(medico)){
                        temp_nombres = (medico['nombres'].split(" "))[0]
                    }

                let temp_apellidos = ""
                    if(!is_undefined(medico)){
                        temp_apellidos = (medico['apellidos'].split(" "))[0]
                    }
                let temp_prefijo = ""
                    if(!is_undefined(medico)){
                        temp_prefijo = medico['prefijo']+' '
                    }

                    return `${temp_prefijo}${temp_apellidos} ${temp_nombres.slice(0,1)}. `
            },
            getImagen(item4){
                let medico = this.$store.state.listadoEquipoCirugia.find(x=>x.user_id===item4.id)
                return is_undefined(medico)?"#":medico['imagen']
            },
            is_object(item){
                console.log(typeof item,item)
                if(typeof item ==="object"){
                    return true
                }else{
                    return false
                }



            },
            getHistorialHorasQx(item2){
                let objeto = JSON.parse(item2['h_real_inicio'] )
                let objetoOrdenado = []
                    objeto.forEach(x=>{
                        objetoOrdenado.unshift(x)
                    })
                return objetoOrdenado
            },
            getOtroPersonalAsistencial(personalTag){
                //console.log("--->",this.$store.state.otroPersonalAsistencial)
            let result = this.$store.state.otroPersonalAsistencial
                if(is_undefined(result)){
                    return []
                }
                return result.filter(x=>x['tipo_personal']===personalTag)
            },
            filteredListSolicitudes(){
                return  this.$store.state.solicitudes
            },
            getPagesCarausel(){
                let tamanoMaximo =20
                const resultado = [];

                for (let i = 0; i < this.filteredListSolicitudes().length; i += tamanoMaximo) {
                    const subarray = this.filteredListSolicitudes().slice(i, i + tamanoMaximo);
                    resultado.push(subarray);
                }

                return resultado;
            },
            getSetCirujanos(items){

                let colection =  Array.from( new Set(items.map(x=>x.cirujano_principal).flat().map(x=> {
                                        return {
                                            "id":x.id,
                                            "description":x.description,
                                        }
                                    }))
                                )
                    // console.log(colection)

                return colection
            },
            getSetEspecialidad(id){
                let result = this.$store.state.listadoEquipoCirugia.find(x=> Number(x['user_id']) === Number(id) )
                console.log("result:",result)
                return !is_undefined(result) ?result['especialidad']:'No disponible'

            },
            getBgColor(id){
                let model = this.$store.state.personalAsistencial.find(x=>x['id']===id)
                return !is_undefined(model) ? model['backgroundColor'] :'var(--white)'
            },
            /* getTiempoCirugia(solicitud) {
                let {h_inicio,h_fin,h_aprox_fin} = solicitud
                if(!is_null(h_fin)){
                    let horaEnMs = 3600000 // una hora en milisegundos
                    let total_horas_iqxMs = h_aprox_fin * horaEnMs
                        //h_inicio = h_inicio.split(" ")
                        //h_fin = h_fin.split(" ")

                    let h_inicioMs = (new Date(h_inicio)).getTime()
                    let hora_estimada_finMs = (h_inicioMs + total_horas_iqxMs )
                    let hora_real_finMs = (new Date(h_fin)).getTime()

                    let minutos_excedido = 0
                    let minutos_ahorrado = 0
                    let hora_estimada_fin = formatAMPM( new Date( hora_estimada_finMs ) )
                        //console.log("hora_estimada_fin",hora_estimada_fin)

                    let diferenciaEnMilisegundos =  hora_estimada_finMs - hora_real_finMs ;
                        //console.log("diferenciaEnMilisegundos",diferenciaEnMilisegundos)
                        if (diferenciaEnMilisegundos < 0) {
                            minutos_excedido = minutos_excedido +  Math.floor( ( (diferenciaEnMilisegundos *(-1)) / 1000) / 60 )
                            //console.log("minutos_excedido",minutos_excedido)
                        }else{
                            minutos_ahorrado = minutos_ahorrado + Math.floor( ( diferenciaEnMilisegundos / 1000) / 60 )
                            //console.log("minutos_ahorrado",minutos_ahorrado)
                        }
                    let message = ""
                    let icono = "fas fa-minus"
                    let color = "success"
                        if(minutos_excedido > 0){
                            message =  `La IQX se excedió ${minutos_excedido} minutos más de lo estimado.`
                            color ="warning text-white"
                        }
                        if(minutos_excedido > 10){
                            message =  `La IQX se excedió ${minutos_excedido} minutos más de lo estimado.`
                            color ="danger"
                        }
                        if(minutos_ahorrado > 0){
                            message =  `La IQX se culminó ${minutos_ahorrado} minutos antes de lo estimado.`
                            icono = "fas fa-plus"
                        }

                        return {
                            hora_estimada_fin,
                            message,
                            color,
                            "tiempo": `${diferenciaEnMilisegundos<0?minutos_excedido :minutos_ahorrado} min.`,
                            icono
                        }


                }
                return false
            }, */
            getTiempoCirugia(solicitud) {
                let h_inicio = JSON.parse(solicitud['h_real_inicio'])[ JSON.parse(solicitud['h_real_inicio']).length - 1]['h_inicio']
                let {h_fin,h_aprox_fin} = solicitud
                if(!is_null(h_fin)){
                    let horaEnMs = 3600000 // una hora en milisegundos
                    let total_horas_iqxMs = h_aprox_fin * horaEnMs

                    let h_inicioMs = (new Date(h_inicio)).getTime()

                    let hora_real_finMs = (new Date(h_fin)).getTime()

                    let duracion_total_iqxMs =  hora_real_finMs - h_inicioMs ;
                    //console.log(duracion_total_iqxMs)
                    let duracion_total_iqx = {
                            hora: Math.floor(duracion_total_iqxMs / (1000 * 60 * 60)),
                            minutos: Math.floor((duracion_total_iqxMs % (1000 * 60 * 60)) / (1000 * 60)),
                        }
                       //console.log(duracion_total_iqx)
                    let hora = ""
                    let minutos = ""
                        if (duracion_total_iqx.hora > 0) {
                            hora = `${duracion_total_iqx.hora} hora${duracion_total_iqx.hora > 1 ?'s':''} `
                        }
                        if (duracion_total_iqx.minutos > 0) {
                            minutos = `${duracion_total_iqx.minutos} min${duracion_total_iqx.minutos > 1 ?'s':''} `
                        }
                        duracion_total_iqx = `${hora}${minutos}`
                       // console.log(duracion_total_iqx)
                    /*





                         */



                    let hora_estimada_finMs = (h_inicioMs + ( total_horas_iqxMs ) )


                    //let minutos_excedido = 0
                    //let minutos_ahorrado = 0
                    let hora_estimada_fin = formatAMPM( new Date( hora_estimada_finMs ) )

                   /*  let diferenciaEnMilisegundos =  hora_estimada_finMs - hora_real_finMs ;
                        if (diferenciaEnMilisegundos < 0) {
                            minutos_excedido = minutos_excedido +  Math.floor( ( (diferenciaEnMilisegundos *(-1)) / 1000) / 60 )
                        }else{
                            minutos_ahorrado = minutos_ahorrado + Math.floor( ( diferenciaEnMilisegundos / 1000) / 60 )
                        } */
                    //let message = ""
                    //let icono = "fas fa-minus"
                    /* let color = "success"
                        if(minutos_excedido > 0){
                            message =  `La IQX se excedió ${minutos_excedido} minutos más de lo estimado.`
                            color ="warning text-white"
                        }
                        if(minutos_excedido > 10){
                            message =  `La IQX se excedió ${minutos_excedido} minutos más de lo estimado.`
                            color ="danger"
                        }
                        if(minutos_ahorrado > 0){
                            message =  `La IQX se culminó ${minutos_ahorrado} minutos antes de lo estimado.`
                            icono = "fas fa-plus"
                        } */

                        return {
                            duracion_total_iqx,
                            hora_estimada_fin,
                            //message,
                            //color,
                            //"tiempo": `${diferenciaEnMilisegundos<0?minutos_excedido :minutos_ahorrado} min.`,
                            //icono
                        }


                }
                return false
            },
            getTiempoCirugiaQx(solicitud) {
                let {h_fin,h_aprox_fin} = solicitud
                let h_inicio = JSON.parse(solicitud['h_real_inicio'])[ JSON.parse(solicitud['h_real_inicio']).length - 1]['h_inicio']
                let horaEnMs = 3600000 // una hora en milisegundos
                let total_horas_iqxMs = h_aprox_fin * horaEnMs

                let h_inicioMs = (new Date(h_inicio)).getTime()

                let hora_real_finMs = (new Date(h_fin)).getTime()

                    let hora_estimada_finMs = (h_inicioMs + ( total_horas_iqxMs ) )

                    let fechaFin =(h_fin===null) ? timestamps() :h_fin
                    // Convertir los timestamps a objetos Date
                    let inicio = new Date(h_inicio);
                    let fin = new Date(fechaFin);

                    // Calcular la diferencia en milisegundos
                    let diferencia = fin - inicio;

                    // Convertir la diferencia a minutos y horas
                    let minutosTotales = Math.floor(diferencia / 60000);
                    let horas = Math.floor(minutosTotales / 60);
                    let minutos = minutosTotales % 60;
                    let duracion_total_iqx ={horas, minutos}
                    let hora = ""
                    let minuto = ""
                        if (duracion_total_iqx.horas > 0) {
                            hora = `${duracion_total_iqx.horas} hora${duracion_total_iqx.horas > 1 ?'s':''} `
                        }
                        if (duracion_total_iqx.minutos > 0) {
                            minuto = `${duracion_total_iqx.minutos} min${duracion_total_iqx.minutos > 1 ?'s':''} `
                        }
                        duracion_total_iqx = `${hora}${minuto}`


                    let hora_estimada_fin = formatAMPM( new Date( hora_estimada_finMs ) )
                        //console.log(duracion_total_iqx)

                        return {
                            duracion_total_iqx,
                            hora_estimada_fin,
                        }
            },
            getUbicacion(id){
                let result = this.$store.state.catUbicacion.find(x=>Number(x['id'])===Number(id) )
                return is_undefined(result)? '': /* result.description +" | "+ */ result.coments
            },
            get_json(param){
                let model =  [];
                if (param !== null ) {
                    model = JSON.parse(param)
                }
                return model
            },
            horaAMPM2(param){
                let m = "AM"
                let p = param.split(":")
                let hora = p[0];
                    //console.log(p[0])
                    if (parseInt(p[0]) >= 12) {
                        m = "PM"
                        switch(p[0]){
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

                        }
                    }
                    if (parseInt(p[0]) === 0) {
                        hora = "12";
                    }

                    return `${hora.padStart(2, '0')}:${p[1].padStart(2, '0')} ${m.toString().padStart(2, '0')}`


            },
            get_hora_inicio(solicitud){
                let h = new Date(solicitud)
                let hora_inicio = this.horaAMPM2(h.getHours()+":"+h.getMinutes())
                return hora_inicio
            },
            horaAMPM(h_inicio){
               //console.log("horaAMPM",h_inicio)
                let h = h_inicio.split(" ")
                let fullHora = h[1].split(":")

                let hora = fullHora[0];
                let minutos = fullHora[1];

                let horario = "AM"
                    if (parseInt(hora) >= 12 && parseInt(hora) <= 23) {
                        horario = "PM"
                    }
                    switch(hora){
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
        },
        async mounted() {
            //console.log("---->",this.$store.state.solicitudes)
            /* this.$store.state.solicitudes.forEach(item=>{
                console.log(item.h_inicio)
            }) */
            //calcularTiempoRestante(timestampInicio, horasASumar, index)

        },
    }
</script>

<style>
.badge-pink {
    color: #ffffff;
    background-color: #f278b0;
}
.tachado{
    text-decoration:line-through;
}
.text-preanestesia{
    color:#f2ffa9;

}
.text-clave-espera{
    color:#ffc107;;

}
.text-quirofano{
    color:#a9e2ff;

}
.text-recuperacion{
    color:#dcffc8;
}
.text-hospitalizacion {
    color: #cbe3ff;
}
.text-uti {
    color: #e1cc8c;
}

.text-alta{
    color:#eadfff;
}
</style>
