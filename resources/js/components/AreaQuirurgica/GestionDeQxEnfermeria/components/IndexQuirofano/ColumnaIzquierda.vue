<template>
    <div class="flex-grow-1 d-flex flex-column overflow-auto">
        <div class="accordion pt-2 flex-grow-1 shadow overflow-auto" id="accordionExample">
            <div v-if="listadoSolicitudesEstaCargando" class="d-flex my-2 justify-content-center align-items-center">
                <strong class="text-primary">Buscando solicitudes...</strong>
                <div class="ml-1 spinner-border text-primary" role="status" aria-hidden="true"></div>
            </div>
            <div v-if="listadoSolicitudesEstaVacio"  class="mb-2 text-center text-primary" >
                No se encontraron solicitudes de quirófano
            </div>
            <!-- v-if="item.dias.length > 0" -->
            <div  :key="index "  v-for="(item,index) in listadoSolicitudesQx"  class="card mb-2">
            <div class="card-header p-1" :id="'headingOne'+index">
                <h2 class="mb-0">
                <button class="btn btn-link btn-block d-flex justify-content-start  align-items-center" type="button" data-toggle="collapse" :data-target="'#collapseOne'+index" aria-expanded="true" :aria-controls="'collapseOne'+index">

                    <h5 class="mb-0 "><b>{{ formatTabFecha(item.fecha)[2] }}</b> {{ formatTabFecha(item.fecha)[1] }}</h5>
                    <div class="mx-3 font-weight-bold">|</div>
                    <div  title="Total Programadas:">
                        <i class="fas fa-calendar-alt mr-1"></i>
                        <h5 class="mb-0 mt-1 badge badge-primary">{{ item.dias.length }}</h5>
                    </div>

                    <div :class="{'d-flex align-items-center mr-1':true,'d-none': item.dias.length===0}" title="Total Ejecutadas:">
                        <div class="mx-3 font-weight-bold">|</div>
                        <i :class="{'fas fa-check mr-1':true,'text-purple':item.dias.filter(x=>x.h_fin !== null).length > 0,'text-secondary':item.dias.filter(x=>x.h_fin !== null).length === 0 }"></i>
                        <h5 :class="{'mb-0 mt-1 badge ':true,'badge-purple':item.dias.filter(x=>x.h_fin !== null).length > 0,'badge-secondary':item.dias.filter(x=>x.h_fin !== null).length === 0}">
                            {{ item.dias.filter(x=>x.h_fin !== null).length }}
                        </h5>

                    </div>

                </button>
                </h2>
            </div>

            <div :id="'collapseOne'+index" :class="{'collapse':true,}" :aria-labelledby="'headingOne'+index" data-parent="#accordionExample">
                <div class="card-body table-responsive p-1 pb-5">
                    <table class="table table-bordered border-0">
                        <thead v-if="existenSolicitudesQx">
                            <tr  class="text-center sticky bg-primary">
                                <th class="tbl-row-radius-left">Qx</th>
                                <th>Fecha Programación</th>
                                <th>Paciente</th>
                                <!-- <th>Intervención</th> -->
                                <!-- <th>Cirujano Principal</th> -->
                                <th>Anestesiólogo</th>
                                <th class="d-none">Equipos Especiales</th>
                                <th>Personal Asistencial</th>
                                <!-- <th>Área IQX</th> -->
                               <!--  <th>Destino</th>
                                <th class="tbl-row-radius-right">Acciones</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <!-- v-if="existenSolicitudesQx && mostrarSolicitud(item.fecha, item2.h_inicio )" -->
                            <tr    v-for="(item2,index2) in item.dias" :key="index2" >
                                <th class="p-1 tbl-row-radius-left h4 mb-0 valign-center text-center" :style="{'display':'table-cell','vertical-align': 'middle'}">
                                    <h1 class="font-weight-bold" :style="{'color':getBgColor(item2.n_quirofano)}">QX{{ item2.n_quirofano }}</h1>
                                  
                                </th>
                                <td class="p-1">
                                    <div class="d-flex flex-column">
                                        <div>
                                            <i class="fas fa-calendar-alt text-primary"></i> {{ fechaFormat( item2.fecha_reservacion) }}
                                        </div>
                                        <div>
                                            <i class="fas fa-clock text-success"></i> {{ horaAMPM(item2.h_inicio) }}
                                        </div>
                                        <div>
                                            <i class="fas fa-stopwatch text-info"></i> {{ parseFloat( item2.h_aprox_fin ) < 1 ? (parseFloat( item2.h_aprox_fin ) *60) +' min' : item2.h_aprox_fin+' hora' }}
                                        </div>
                                    </div>
                                </td>
                                <td class="p-2">

                                    <div class="d-flex flex-column">
                                        <h4 class="text-secondary text-nowrap">
                                            {{item2.paciente}}
                                        </h4>
                                        <div class="btn-group p-0 align-self-start ml-1">
                                            <div
                                                :class="['py-0 px-1 rounded ',{'bg-danger':item2.tipo_reservacion ==='Emergencia','bg-warning text-white':item2.tipo_reservacion ==='Electiva'}]"
                                                id="triggerId"
                                                :title="item2.tipo_reservacion"
                                                style="font-size: 1rem;"
                                            >
                                                <div v-if="item2.tipo_reservacion ==='Emergencia'">EMER</div>
                                                <div v-if="item2.tipo_reservacion ==='Electiva'">ELEC</div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </td>
                                <td class="p-2">
                                    <!-- $store.state.listadoSolicitudesQx[index]['dias'][index2]['intervencion'] -->
                                  
                                    <TodolistDropdownAnestesiologo
                                        :solicitud_quirofano_id="item2.id"
                                        :n_quirofano="item2.n_quirofano"
                                        :user_id_paciente="item2.user_id_paciente"
                                        :index="index"
                                        :index2="index2"
                                        
                                    />
                                    <!-- 
                                    <ol  v-for="(item3,index3) in JSON.parse(item2.intervencion)" :key="index3"  style='padding: 5px 10px' class='mb-0'>

                                        <li class="text-secondary" :key="index4" v-for="(item4,index4) in   item3['anestesiologo']">
                                            {{item4.description}}
                                        </li>
                                    </ol> -->
                                </td>
                                <td class="p-2">
                                    <div class="d-flex flex-column">
                                        <TodolistDropdownCirculanteAnestesia
                                            :solicitud_quirofano_id="item2.id"
                                            :n_quirofano="item2.n_quirofano"
                                            :user_id_paciente="item2.user_id_paciente"
                                        />

                                        <TodolistDropdownCirculanteCirugia
                                            :solicitud_quirofano_id="item2.id"
                                            :n_quirofano="item2.n_quirofano"
                                            :user_id_paciente="item2.user_id_paciente"
                                        />
                                        <TodolistDropdownInstrumentista
                                            :solicitud_quirofano_id="item2.id"
                                            :n_quirofano="item2.n_quirofano"
                                            :user_id_paciente="item2.user_id_paciente"
                                        />


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
    import { fechaDMA, get ,fechaAMD,fechaHoy, meses, post, is_undefined, store_field,is_null, is_empty } from '../../../../../helpers/customHelpers.js';
    import ColumnaPersonalAsistencial from './ColumnaPersonalAsistencial.vue';
    import TodolistDropdownInstrumentista from './TodolistDropdownInstrumentista.vue';
    import TodolistDropdownCirculanteCirugia from './TodolistDropdownCirculanteCirugia.vue';
    import TodolistDropdownCirculanteAnestesia from './TodolistDropdownCirculanteAnestesia.vue';
    import TodolistDropdownAnestesiologo from './TodolistDropdownAnestesiologo.vue';

    export default {
        components:{
            ColumnaPersonalAsistencial,
            TodolistDropdownInstrumentista,
            TodolistDropdownCirculanteCirugia,
            TodolistDropdownCirculanteAnestesia,
            TodolistDropdownAnestesiologo,
        },
        data() {
            return {
                listadoSolicitudesEstaVacio:false,
                listadoSolicitudesEstaCargando:true,
                edad: 0,
                numeros: Array.from({ length: 24 }, (_, index) => index + 1), // Genera un arreglo con números del 1 al 24
            };
        },
        watch: {
            '$route'(to, from) {

            this.getSolicitudesQx()

            }
        },
        methods:{
            
            getUbicacionesOrdenadas(){
                let array_filter = [418,420,421,419,422,423,424,425]
                // Objeto de datos
                let data = this.$store.state.catUbicacion.filter(x=>array_filter.includes(Number(x['id']) ) ) //418,419,420,421,422,423,424,425

                // Array con el orden deseado
                const orderToArray = array_filter; //,419,,424,425

                // Construir un nuevo objeto ordenado
                const orderedData = [];
                orderToArray.forEach( item => {
                    orderedData.push( data.find(x=> x['id'] ===item ) ) ;
                });
                return orderedData
            },
            getUbicacion(id){
                let result = this.$store.state.catUbicacion.find(x=>x['id']===Number(id) )
                return is_undefined(result)? '': result.description +" | "+result.coments
            },

            fechaFormat(fecha,divider="/"){
                //return fecha

                let nuevaFecha = fecha.split(" ")
                    nuevaFecha = nuevaFecha[0].split("-")

                    return nuevaFecha[2].toString().padStart(2, '0') + divider + nuevaFecha[1].toString().padStart(2, '0') + divider +   nuevaFecha[0]
            },
            editSolicitud(id){
                this.$store.commit('updateProperty', {
                    fieldName:'loading',
                    fieldValue:true,
                });
                //console.log("--->",id)
                //this.$store.state.edit_solicitud_id
                localStorage.setItem("editSolicitud",id)
                this.$store.commit('editSolicitud',id)

                this.$router.push('/areaQuirofano/edit_quirofano')
                //location.href="/areaQuirofano/edit_quirofano"
            },
            dropdownStop(e){
                 e.stopPropagation();
               // console.log(`${e.target.textContent} clicado!`);
            },
            getBgColor(id){
                let model = this.$store.state.personalAsistencial.find(x=>x['id']===id)
                return !is_undefined(model) ? model['backgroundColor'] :'var(--white)'
            },
            getColor(id){
                let model = this.$store.state.personalAsistencial.find(x=>x['id']===id)
                return !is_undefined(model) ? model['textColor'] :'var(--secondary)'
            },
            getSetCirujanos(items){
                let colection =  Array.from( new Set(items.map(x=>x.cirujano_principal).flat().map(x=>x.description)) )
                //console.log(colection)

                return colection
            },
            async finalizarReservacion(e){
                //console.log(e.dataset)
                //console.log(e.currentTarget.dataset)
                let {index,index2,reservacion_id} = e.currentTarget.dataset

                Swal.fire({
                    icon:"warning",
                    title: '¿Deseas finalizar esta solicitud?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: 'Si!, finalizar',
                    denyButtonText: `No!, aún no`,
                    }).then( async (result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        this.$store.commit('updateSolicitudQxFinalizar',[index,index2])
                        let result = await get(location.origin + `/areaQuirofano/visibilidadReservacion/${reservacion_id}/3`)
                    }
                })


            },
            async qxRealizada(e){

                let {index,index2,reservacion_id} = e.currentTarget.dataset

                Swal.fire({
                    icon:"warning",
                    title: '¿La cirugía fue realizada?',
                    html:`
                        <label>Si es sí, indica la <b>fecha y hora</b> en que finalizó:</label>
                        <div class="d-flex">
                            <input type="date" class="form-control" id="fecha_fin">
                            <input type="time" class="form-control" id="h_fin">
                        </div>

                    `,
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: 'Si!',
                    denyButtonText: `No`,
                    showLoaderOnConfirm: true,

                    allowOutsideClick: () => !Swal.isLoading()
                }).then( async (result) => {
                    let input1 = document.getElementById('fecha_fin')
                    let input2 = document.getElementById('h_fin')
                    let fecha_fin = input1.value
                    let h_fin = input2.value
                    if (result.isConfirmed) {

                       //console.log()
                        if(is_empty(input1.value)){
                            alert("No has indicado la fecha de fin.")
                            input1.focus()
                            fecha_fin = null
                            return false
                        }
                        if(is_empty(input2.value)){
                            alert("No has indicado la hora de fin.")
                            input2.focus()
                            h_fin = null
                            return false
                        }
                        h_fin =  fecha_fin+" "+h_fin

                        this.$store.commit('updateSolicitudQx2',[index,index2,'h_fin', h_fin])



                    }else if (result.isDenied) {
                        h_fin = ""
                        this.$store.commit('updateSolicitudQx2',[index,index2,'h_fin',null])
                        //this.$store.commit('updateSolicitudQx2',[index,index2,'status_id',1])
                    }

                    let formData = new FormData();
                        formData.append("id",reservacion_id)
                        formData.append("field",'h_fin')
                        formData.append("value", h_fin )
                        formData.append("_token", document.querySelector('meta[name="csrf-token"]').getAttribute('content') )

                    let result2 = await post(location.origin + `/areaQuirofano/update`,formData)

                    this.handleRegProgramacion(
                    '¿Deseas reubicar al paciente?',
                    'fase_ubicacion',
                    'Recuperación' ,
                        reservacion_id,
                        index2,
                        index
                    )
                   // console.log(result2)
                })





            },
            horaAMPM(h_inicio){

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
            horaAMPM2(param){
                //let m = "AM"

                let p = param.split(" ")
                    p = p[1].split(":")

                    return `${p[0].padStart(2, '0')}:${p[1].padStart(2, '0')}`


            },
            getTime(param){
                let hoy = new Date(param);
                //console.log(hoy)
                return hoy.getHours() + ":" + hoy.getMinutes()
            },
            async handleRegProgramacion(message,field,value,id,index,index2){
                //console.log(this.listadoSolicitudesQx)
                /* Swal.fire({
                    icon:"warning",
                    title: message,
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: 'Si!',
                    denyButtonText: `No, aún no`,
                    }).then( async (result) => {

                    if (result.isConfirmed) { */
                        let formData = new FormData();
                            formData.append("id",id)
                            formData.append("field",field)
                            formData.append("value",value)
                            formData.append("_token", document.querySelector('meta[name="csrf-token"]').getAttribute('content') )

                        let result2 = await post(location.origin + `/areaQuirofano/update`,formData)

                            this.$store.commit('updateSolicitudQx2',[index2,index,field,value])
                            if (field =="fecha_reservacion") {
                                let h_aprox_fin = (document.querySelector(`#fecha_reservacion_${id}`).dataset.h_aprox_fin).split(" ")
                                formData = new FormData();
                                    formData.append("id",id)
                                    formData.append("field","h_aprox_fin")
                                    formData.append("value",value +" "+ h_aprox_fin[1])
                                    formData.append("_token", document.querySelector('meta[name="csrf-token"]').getAttribute('content') )
                                    result2 = await post(location.origin + `/areaQuirofano/update`,formData)



                                let hora = document.querySelector(`#hora_reservacion_${id}`).value
                                    formData = new FormData();
                                    formData.append("id",id)
                                    formData.append("field","h_inicio")
                                    formData.append("value",value +" "+ hora)
                                    formData.append("_token", document.querySelector('meta[name="csrf-token"]').getAttribute('content') )
                                    result2 = await post(location.origin + `/areaQuirofano/update`,formData)


                            }
                             //actualizar en la vista la fecha
                             await this.getSolicitudesQx()
                             if([].includes(field)){
                                 Swal.fire({
                                    icon: "success",
                                    title: "Programación actualizada",
                                    text:"Los datos de la solicitud han sido actualizados correctamente.",

                                })
                             }

                    /* }else if (result.isDenied) {
                        //this.$store.commit('updateSolicitudQx',[index,index2])
                        //let result = await get(location.origin + `/areaQuirofano/visibilidadReservacion/${reservacion_id}/${this.$store.state.listadoSolicitudesQx[ index ]['dias'][ index2 ]['status_id']}`)
                    }
                }) */
            },
            async getSolicitudesQx(){
                try {

                    let model

                    if(this.$route.path=="/areaQuirofano/enfermeria/index_enfermeria"){
                        model =  await get(location.origin + '/areaQuirofano/cupo/getAllInterno' )
                    }else{
                        model =  await get(location.origin + '/areaQuirofano/cupo/getAllFinalizadas' )
                    }
                    if(model.length === 0){
                        this.listadoSolicitudesEstaVacio =true
                    }else{
                        this.listadoSolicitudesEstaVacio =false
                    }
                    let solicitudesPorDia = []
                        //obtenemos las fechas unicas
                    let fechas_unicas = Array.from( new Set(model.map(item=>{
                            let h_inicio = item['h_inicio'].split(" ")
                            return h_inicio[0]
                        }) ) )
                        //eliminamos los valores null
                        .filter(item=>item !== null)

                        //convertimos las fechas a milisegunsos para luego poderlas ordenar
                        fechas_unicas = fechas_unicas.map(item=>{
                            let fecha = new Date(item)
                            return {"milisegundos":fecha.getTime(),"original":item}
                        })
                        //las ordenamos
                        if(this.$route.path=="/areaQuirofano/index_enfermeria"){
                            fechas_unicas = fechas_unicas.sort((a, b) => a.milisegundos - b.milisegundos)
                        }else{
                            fechas_unicas = fechas_unicas.sort((a, b) => b.milisegundos - a.milisegundos)
                        }

                        //console.log("--->",fechas_unicas)
                        //la volvemos a convertir a formato fecha
                       /*  fechas_unicas = fechas_unicas.map(item=>{
                            return item //fechaAMD( item )
                        }) */



                        fechas_unicas.forEach(item=>{
                            solicitudesPorDia.push({
                                fecha:item.original,
                                dias:model.filter(item2=>{
                                    let h_inicio = item2['h_inicio'].split(" ")
                                        if(h_inicio[0] === item.original){
                                            return item2
                                        }

                                })
                                //.sort((a, b) => Date.parse(b.h_inicio) - Date.parse(a.h_inicio)),
                            })
                        })
                        //console.log("solicitudesPorDia",solicitudesPorDia)
                        //console.log(solicitudesPorDia)
                        this.$store.commit('updateListadoSolicitudesQx',solicitudesPorDia)
                } catch (error) {
                    console.error('Error al obtener los datos:', error);
                    return []
                }
            },
            isSelected(param){
                //console.log(param,currentId)
                if(param !==null){
                    let option = JSON.parse(param)
                   // console.log( option.id)
                    return Number(option.id)
                    /* if(Number(currentId) === Number(option.id)){
                        return true
                    }else{
                        return false
                    } */
                }
                return 0

            },
            async handleFaseUbicacion(e){
                let button = e.target
                let {input_name,input_value,reservacion_id,index,index2} = button.dataset

                this.handleRegProgramacion(
                    '¿Deseas reubicar al paciente?',
                    input_name,
                    input_value ,
                    reservacion_id,
                    index2,
                    index
                )

            },
            async handlehoraProgramacion(e){
                let tag = e.target
                let input_value
                if(e.target.tagName==="BUTTON"){
                    input_value = tag.previousElementSibling.value
                }
                if(e.target.tagName==="INPUT"){
                    input_value = tag.value
                }
                //let button = e.target
                //let input_value = button.previousElementSibling.value
                let {input_name,reservacion_id,index,index2} = tag.dataset
                let fecha = document.querySelector(`#fecha_reservacion_${reservacion_id}`).value

                this.handleRegProgramacion(
                    '¿Deseas reprogramar la hora de la intervención?',
                    input_name,
                    fecha+" "+input_value,
                    reservacion_id,
                    index2,
                    index
                )

            },
            async handleTiempoProgramacion(e){
                let tag = e.target
                /* let input_value
                if(e.target.tagName==="BUTTON"){
                    input_value = tag.previousElementSibling.value
                }
                if(e.target.tagName==="INPUT"){
                    input_value = tag.value
                } */

                //let button = e.target
                let {input_name,reservacion_id,index,index2} = tag.dataset
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
            async handleTipoReservacion(e){
                let tag = e.target

                let {input_name,reservacion_id,index,index2} = tag.dataset
                console.log(input_name+reservacion_id)
                let input_value = document.querySelector(`#${input_name+'_'+reservacion_id}`).value

                this.handleRegProgramacion(
                    '¿Deseas actualizar el tipo de reservación?',
                    input_name,
                    input_value,
                    reservacion_id,
                    index2,
                    index
                )

            },
            async handlePersonalAsistencial(e){
                let button = e.target
                let {input_name,reservacion_id,index,index2} = button.dataset
                let input_value = document.querySelector(`#${input_name+reservacion_id}`)
                let selectedOption = input_value.options[input_value.selectedIndex];

                let temp_object = {
                            "id": selectedOption.value,
                            "description": selectedOption.text,
                        }
                //console.log(JSON.stringify(temp_object))
                this.handleRegProgramacion(
                    '¿Deseas actualizar el personal asistencial?',
                    input_name,
                    JSON.stringify(temp_object),
                    reservacion_id,
                    index2,
                    index
                )

            },
            async handleDestino(e){
                let button = e.target
                let {input_name,reservacion_id,index,index2} = button.dataset
                let input_value = document.querySelector(`#${input_name+reservacion_id}`).value


                //console.log(JSON.stringify(temp_object))
                this.handleRegProgramacion(
                    '¿Deseas actualizar el destino?',
                    input_name,
                    input_value,
                    reservacion_id,
                    index2,
                    index
                )

            },
            async handleFechaProgramacion(e){

                let tag = e.target
                let input_value
                if(e.target.tagName==="BUTTON"){
                    input_value = tag.previousElementSibling.value
                }
                if(e.target.tagName==="INPUT"){
                    input_value = tag.value
                }
                let {input_name,reservacion_id,index,index2} = tag.dataset
                let hora = document.querySelector(`#hora_reservacion_${reservacion_id}`).value

                this.handleRegProgramacion(
                    '¿Deseas reprogramar la fecha de la intervención?',
                    input_name,
                    input_value+" "+hora,
                    reservacion_id,
                    index2,
                    index
                )

            },
            formatTabFecha(fecha){
                //console.log("3------>",fecha)
                let date = fecha.split("-")
                return [
                    date[0],
                    meses( Number(date[1])-1 ).slice(0,3).toUpperCase(),
                    date[2],
                ]
            },
            mostrarSolicitud(fechaGrupo,fechaSolicitud){
                //console.log(fechaGrupo,fechaSolicitud)
                if(fechaGrupo === fechaAMD(fechaSolicitud) ){
                    return true
                }else{
                    return false
                }
            },
            handle_is_null(data){
               return is_null(data)
            },
            async getPersonalAsistencial(){

                try {
                    this.listadoQuirofanoEstaCargando =true
                    let model = await get(location.origin + '/areaQuirofano/personal_asistencial/gelAll' )

                        this.$store.commit('updatePersonalAsistencial',model)

                        model = await get(location.origin + '/areaQuirofano/personal_asistencial/gelAllOtroPersonal' )
                        this.$store.commit('updateOtroPersonalAsistencial',model)


                    this.listadoQuirofanoEstaCargando =false
                } catch (error) {
                    this.listadoQuirofanoEstaCargando =false
                    console.error('Error al obtener los datos:', error);
                    return []
                }
            },
        },
        computed:{

            existenSolicitudesQx(){
                let result =  this.$store.state.listadoSolicitudesQx
                //console.log(result)
                if(result.length === 0){
                    this.listadoSolicitudesEstaVacio =true
                }else{
                    this.listadoSolicitudesEstaVacio =false
                }
                return result
            },
            listadoSolicitudesQx(){
                //console.log(this.$store.getters.listadoSolicitudesQx)
                return  this.$store.getters.listadoSolicitudesQx.sort((a, b) => a['n_quirofano'] - b['n_quirofano']);
            }
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
    button.btn-link:hover,
    .btn-link:hover{
        background-color: rgb(236, 236, 236) !important;
    }
    .bg-preanestesia{
        background-color:#f2ffa9;

    }
    .bg-quirofano{
        background-color:#a9e2ff;

    }
    .bg-recuperacion{
        background-color:#dcffc8;
    }
    .bg-hospitalizacion {
        background-color: #cbe3ff;
    }
    .bg-uti {
        background-color: #e1cc8c;
    }

    .bg-alta{
        background-color:#eadfff;
    }
    /*.bg-hospitalizacion{
        background-color:var(--primary);
        color:white;
    }
    .bg-ambulatorio{
        background-color: var(--success);
        color:white;
    }*/
    .blink-2{-webkit-animation:blink-2 .9s infinite both;animation:blink-2 .9s infinite both}
    @-webkit-keyframes blink-2{0%{opacity:1}50%{opacity:.2}100%{opacity:1}}@keyframes blink-2{0%{opacity:1}50%{opacity:.2}100%{opacity:1}}
</style>

