<template>
    <div class="flex-fill d-flex flex-column flex-md-row overflow-auto pt-2">
        <!-- COLUMNA 1 -->
        <div class="order-2 order-md-1 flex-fill col-md-6 d-flex flex-column overflow-auto ">
            <h4 class="title_create text-secondary">Añadir {{ dataGrupoMedico.group_cargo }}:</h4>
            <input @change="filtroTabla" type="search" id="modal_search_medico" placeholder="Escribe Tratante a buscar..." class="form-control">
            <div class="alert alert-success my-1">
                <b>Pulsa</b> en un médico del siguiente listado para asignarlo al paciente.
            </div>
            <div :class="['cargando-busqueda',{'d-none':!buscando}]" style="">
                Espere un momento por favor...
                <div class="spinner-border" role="status">
                    <span class="sr-only"></span>
                </div>
            </div>
            <div class="flex-fill d-flex flex-column overflow-auto">
                <div id="modal-listado_medicos" class="d-flex flex-column overflow-auto pt-1 border rounded border-gray ">
                    <ul v-for="(item,index) in medicosDisponiblesPorEspecialidad" :key="index" class="list-group list-group-flush">
                        <li

                            :class="['list-group-item d-flex font-weight-bold disabled list-group-item-action p-1','text-'+dataGrupoMedico.color]"
                        >
                            <div>{{ item.description }}</div>
                        </li>
                        <li v-for="(item2,index2) in item.medicos" :key="index2"
                            @click="handleMedicoDisponible"
                            data-grupos_medicos_to_show="9"
                            :data-position_id="item2.posicion_id"
                            :data-user_id_medico="item2.user_id"

                            class=" list-group-item d-flex align-items-center justify-content-between cursor-pointer list-group-item-action py-1">

                            <div class="d-flex align-items-center">
                                <img loading="lazy" style="width: 30px;height: 30px;border-radius: 20px;" class="img-doctor" onerror="this.src='/image/system/patient.svg'" src="/image/system/patient.svg">
                                <div class="ml-1">
                                    {{ item2.medico }}
                                </div>
                            </div>
                            <div class="d-flex flex-column flex-md-row align-items-center">
                                <a
                                    target="_blank"
                                    :href="'https://api.whatsapp.com/send?phone='+ (!['null',null].includes(item2.telefono_movil) ? item2.telefono_movil.replace('+', '') : '')"
                                    v-if="item2.telefono_movil !== null"
                                    :data-tippy-content="'Teléfono contacto del médico: '+item2.telefono_movil"
                                    class="ml-1 mb-1 btn btn-outline-primary btn-small-custom tooltip-primary text-nowrap"
                                >
                                    <i class="ml-1 fab fa-whatsapp text-success"></i>
                                    {{ item2.telefono_movil }}
                                </a>
                                <a
                                    target="_blank"
                                    v-if="item2.extension_telefonica !== null"
                                    class="ml-1 mb-1 btn btn-outline-secondary btn-small-custom text-nowrap"
                                    :href="'tel:'+item2.extension_telefonica"
                                >
                                    <i class="ml-1 fas fa-phone"></i>
                                    {{ item2.extension_telefonica }}
                                </a>
                            </div>

                        </li>

                    </ul>
                </div>
            </div>
            <div :class="['text-center','text-'+dataGrupoMedico.color]">
                Mostrando <b>{{  medicosDisponiblesEnElCargo().length }}</b> resultados
            </div>
        </div>
        <!-- COLUMNA 2 -->
        <div class="order-1 order-md-2 col-md-6 d-flex flex-column overflow-md-auto ">
            <h4 class="title_create text-secondary">Equipo {{ dataGrupoMedico.group_cargo }}:</h4>
            <!-- <div class="p-4 bg-info">
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolore, suscipit.
            </div> -->
            <div class="flex-fill overflow-auto">
                <ul id="modal-listado_medicos_asignados" class="mt-1  rounded border-gray list-group list-group-flush overflow-auto col-listado-paciente-height">

                    <li
                        v-for="(item,index) in medicosDelPaciente" :key="index"

                        class="bg-light list-group-item d-flex align-items-center justify-content-between cursor-pointer list-group-item-action p-1"
                    >
                        <div class="d-flex align-items-center scale-in-hor-left">
                            <div class="d-flex align-items-center">
                                <img loading="lazy" style="width: 30px;height: 30px;border-radius: 20px;" class="img-doctor" onerror="this.src='/image/system/patient.svg'" src="/image/system/patient.svg">
                                <div class="ml-1">
                                    {{ item.medico }}
                                </div>
                            </div>
                            <div class="d-flex flex-column flex-md-row flex-wrap align-items-start">
                                <span class="ml-1 mb-1 badge badge-primary"> {{item.especialidad}}</span>
                                <a
                                    target="_blank"
                                    :href="'https://api.whatsapp.com/send?phone='+ (!['null',null].includes(item.telefono_movil) ? item.telefono_movil.replace('+', '') : '')"
                                    v-if="item.telefono_movil !== null"
                                    :data-tippy-content="'Teléfono contacto del médico: '+item.telefono_movil"
                                    class="ml-1 mb-1 btn btn-outline-primary btn-small-custom tooltip-primary text-nowrap"
                                >
                                    <i class="ml-1 fab fa-whatsapp text-success"></i>
                                    {{ item.telefono_movil }}
                                </a>
                                <a
                                    target="_blank"
                                    v-if="item.extension_telefonica !== null"
                                    class="ml-1 mb-1 btn btn-outline-secondary btn-small-custom text-nowrap"
                                    :href="'tel:'+item.extension_telefonica"
                                >
                                    <i class="ml-1 fas fa-phone"></i>
                                    {{ item.extension_telefonica }}
                                </a>
                            </div>
                        </div>
                        <button
                            @click="handleDestroy(item.medico_paciente_id)"


                            style="width: 30px;height: 30px;font-size: 0.5em;"
                            class="medico-asignado tooltip-danger delete-row btn btn-danger"
                        >
                            <i class="fa fa-minus" aria-hidden="true"></i>
                        </button>
                    </li>
                </ul>
            </div>
            <!-- <div class="p-4">
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Neque, repudiandae!
            </div> -->
        </div>


    </div>




</template>

<script>
    import { timestamps,post, get, is_empty,getSelectorText, is_null,is_undefined } from '../../../helpers/customHelpers';
    export default {
        data() {
            return {
                buscando: false
            }
        },
        props: {
            dataGrupoMedico: {
                type: Object,
                default: function() {
                    return {
                        color:null,
                        grupos_medicos_to_show:"0",
                        tippyContent:null,
                        group_cargo:null,
                    };
                }
            },

        },
        computed: {
            medicosDisponiblesPorEspecialidad(especialidad_id){
                let medicosXEspecialidad =[]
                if (this.especialidadesMedicosDisponibles().length > 0) {
                    this.especialidadesMedicosDisponibles()
                    .forEach(x=>{
                        medicosXEspecialidad.push({
                            id:x.id,
                            description:x.description,
                            medicos:this.medicosDisponiblesEnElCargo().filter(med => Number(med.cat_user_especialidad_id) === Number(x.id))
                        })
                    })
                }
                //console.log(medicosXEspecialidad)
                return medicosXEspecialidad
            },
            medicosDelPaciente(){

            let posiciones_id = this.dataGrupoMedico.grupos_medicos_to_show.split(",").map(x=>Number(x))

                if(["1","2"].includes( this.dataGrupoMedico.grupos_medicos_to_show )){
                        posiciones_id =[Number(this.dataGrupoMedico.grupos_medicos_to_show)]
                }
                //console.log(posiciones_id);
                return this.$store.state.componenteDinamico.dataPaciente.medico_paciente.filter(x=>{
                    if (posiciones_id.includes( x.cat_user_medico_posicion_id )) {
                        return x
                    }
                })
            },
        },
        methods: {
            async destroy(medico_paciente_id){
                ///user_cuest_medico_paciente/eliminarById
                let formdata = new FormData();
                    formdata.append("id", medico_paciente_id )
                    formdata.append("_token", $("#_token").val())
                    formdata.append("created_at", timestamps())
                    return await post( location.origin+"/user_cuest_medico_paciente/eliminarById", formdata)
            },
            async store(user_id_medico,position_id){

                let formdata = new FormData();
                    formdata.append("episodio_id", this.$store.state.componenteDinamico.dataPaciente.episodio_id)
                    formdata.append("user_id_medico", user_id_medico )
                    formdata.append("user_id_paciente", this.$store.state.componenteDinamico.dataPaciente.user_id )
                    formdata.append("position_id", position_id)
                    formdata.append("_token", $("#_token").val())
                    formdata.append("created_at", timestamps())
                    return await post( location.origin+"/user_cuest_medico_paciente/store", formdata)
            },
            handleDestroy(medico_paciente_id){
                Swal.fire({
                    title: `¿Retirar ${this.$store.state.componenteDinamico.dataGrupoMedico.group_cargo}?`,
                    text:`¿Quieres retirar el ${this.$store.state.componenteDinamico.dataGrupoMedico.group_cargo} del paciente ${this.$store.state.componenteDinamico.dataPaciente.paciente}?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, retirar!',
                    cancelButtonText: 'No, aún no!'
                }).then( async (result) => {
                    if (result.isConfirmed) {
                     /*    d.querySelector("#modalLoading").classList.remove("d-none")
                        let temp_medico_posicion_id = position_id
                        if(grupos_medicos_to_show==="1,2"){
                            temp_medico_posicion_id =2
                        }
                        let medico_paciente_id = this.medic_teem_patient.find( (mp,key)=> Number(mp.cat_user_medico_posicion_id) === Number(temp_medico_posicion_id) && Number(mp.user_id_medico) === Number(user_id_medico) )['medico_paciente_id']
                       */  //console.log(medico_paciente_id)

                        let model = await this.destroy( medico_paciente_id )
                        let temp = this.$store.state.componenteDinamico.dataPaciente
                            temp.medico_paciente  = model


                            this.$store.commit('updateObjectValue', {
                                formName: 'componenteDinamico',
                                fieldName: 'dataPaciente',
                                fieldValue: temp
                            });
                            this.$store.commit('updateObjectValue', {
                                formName: 'pacientes_datos',
                                fieldName:  this.$store.state.componenteDinamico.index_row,
                                fieldValue:  this.$store.state.componenteDinamico.dataPaciente
                            });
                       /*  d.querySelector("#modalLoading").classList.add("d-none") */
                        //console.log("user_id_medico",user_id_medico)
                        //console.log(pacientes_datos[ that.episodio_index ]['medico_paciente'])
                        //this.medic_teem_patient = this.medic_teem_patient.filter( (mp,key)=> Number(mp.user_id_medico) !== Number(user_id_medico) )
//pacientes_datos[ that.episodio_index ]['medico_paciente'] = pacientes_datos[ that.episodio_index ]['medico_paciente'].filter( (mp,key)=> Number(mp.user_id_medico) !== Number(user_id_medico) )
                        //console.log(pacientes_datos[ that.episodio_index ]['medico_paciente'])
                        /* that.deployMedicoPacienteList()
                        that.handleOptionListModal({
                            grupos_medicos_to_show,
                            color,
                            group_cargo,
                            position_id,
                            selector_cargo,
                            tippyContent,
                        }) */
                        Swal.fire(
                            `${this.$store.state.componenteDinamico.dataGrupoMedico.group_cargo} retirado!`,
                            `El ${this.$store.state.componenteDinamico.dataGrupoMedico.group_cargo} se retiró correctamente.`,
                            'success'
                        )
                    }
                })
            },
            async handleMedicoDisponible(event){
                let that = this
                let {
                    position_id,
                    user_id_medico,

                    } = event.currentTarget.dataset
                    if(["1","2"].includes( this.dataGrupoMedico.grupos_medicos_to_show )){
                        position_id =Number(this.dataGrupoMedico.grupos_medicos_to_show)
                    }




                    let model = await that.store( user_id_medico, position_id )
                    //d.querySelector("#modalLoading").classList.add("d-none")
                        //this.medic_teem_patient = model
                        let temp = this.$store.state.componenteDinamico.dataPaciente
                            temp.medico_paciente  = model
                        //that.deployMedicoPacienteList()
                        this.$store.commit('updateObjectValue', {
                            formName: 'componenteDinamico',
                            fieldName: 'dataPaciente',
                            fieldValue: temp
                        });
                        this.$store.commit('updateObjectValue', {
                            formName: 'pacientes_datos',
                            fieldName:  this.$store.state.componenteDinamico.index_row,
                            fieldValue:  this.$store.state.componenteDinamico.dataPaciente
                        });
            },
            medicosDisponiblesEnElCargo(){
                let posiciones_id = this.dataGrupoMedico.grupos_medicos_to_show.split(",")
                    if(["1","2"].includes( this.dataGrupoMedico.grupos_medicos_to_show )){
                            posiciones_id =[1,2]
                    }
                let medicosAsignados = this.medicosDelPaciente.map(z=>z['user_id_medico'])

                    return this.$store.state.medicos_datos.filter(med => {
                        if (
                            posiciones_id.map(x=>Number(x)).includes(Number(med.posicion_id)) &&
                            !medicosAsignados.includes(med.user_id_medico)
                        ) {
                            return med
                        }
                    } )
            },
            especialidadesMedicosDisponibles(){
                let especialidades_id = Array.from( new Set(this.medicosDisponiblesEnElCargo().map(med => med.cat_user_especialidad_id)) )
                let especialidades = []
                if (especialidades_id.length > 0) {
                    especialidades_id.forEach(especialidad_id => {
                        let medicos_disponibles_x_especialidad = this.medicosDisponiblesEnElCargo().filter(med => Number(med.cat_user_especialidad_id) === Number(especialidad_id))
                            especialidades.push({
                                id:especialidad_id,
                                description:medicos_disponibles_x_especialidad[0].especialidad
                            })
                    })

                }
                //console.log(especialidades);
                return especialidades
            },



            filtroTabla(event) {
                var busqueda = event.currentTarget.value;

                var table = document.querySelectorAll("#modal-listado_medicos li");


                let texto = busqueda.toLowerCase();
                   /*  var r = 0;
                    let row */
                    this.buscando = true
                    setTimeout(() => {
                        table.forEach((row,index)=>{
                            //onsole.log(row.innerText.toLowerCase().indexOf(texto) !== -1)
                            if (row.innerText.toLowerCase().indexOf(texto) !== -1)
                            table[index].classList.replace("d-none","d-flex") ;

                            else{
                                table[index].classList.replace("d-flex","d-none") ;
                            }

                        })
                        this.buscando = false
                    }, 500);



            }
        },
        mounted () {
            //this.filtroTabla()
           //console.log(this.medicosDisponiblesPorEspecialidad());
        },
    }
</script>

<style lang="scss" scoped>
    .alert-success {
        color: #155724;
        background-color: #d4edda;
        border-color: #c3e6cb;
    }
    .cargando-busqueda{
        position: absolute;
        background-color: rgb(135 135 135 / 20%);
        width: 99%;
        height: 100%;
        z-index: 4;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color:var(--primary)
    }
</style>
