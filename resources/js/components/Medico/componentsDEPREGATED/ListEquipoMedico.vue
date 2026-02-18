<template>
    <div>
        <ul class="list-group list-group-flush">

            <li
                @click="handle_equipo_medico"
                v-for="(item,index) in getItems()" :key="index"
                :data-grupos_medicos_to_show="item.id"
                :data-color="item.color"
                :data-group_cargo="item.description"
                :data-tippy-content="'Equipo '+ item.description"
                :class="['tooltip-success list-group-item cursor-pointer list-group-item-action p-0']">
                <div class="d-flex flex-column">
                    <!-- Tarjeta activa -->
                    <div
                        v-if="getCurrentMedic(item.id) !== undefined"
                        :content="item.description"
                        v-tippy="{ arrow : true, placement:'left-end', zIndex:99999, theme : 'tooltip-'+item.color }"
                        class="d-flex align-items-center overflow-hidden py-1">
                        <span :class="['badge mx-2 medico-badge-width scale-in-hor-left', ('badge-'+item.color) ]">
                            {{ item.sigla() }}
                        </span>
                        <img
                            loading="lazy"
                            class="img-doctor mx-1"
                            onerror="this.src='/image/system/patient.svg'"
                            :src="getCurrentMedic(item.id).medico_img">
                        <b class="text-nowrap text-secondary">
                            {{getCurrentMedic(item.id).medico  }}
                        </b>
                        <span v-if="getCurrentMedic(item.id).extension_telefonica !== null" :class="['ml-auto text-nowrap font-weight-bold text-secondary rounded-pill border px-1',('border-'+item.color)]" style="font-size: 0.8rem;">
                            <i :class="['ml-1 fas fa-phone',('text-'+item.color)]"></i> {{ getCurrentMedic(item.id).extension_telefonica }}
                        </span>
                    </div>
                    <!-- Tarjeta inactiva -->
                    <div v-else :class="['d-flex align-items-center']">
                        <span :class="['badge mx-2 medico-badge-width scale-in-hor-left', ('badge-'+item.color)]">
                            {{ item.sigla() }}
                        </span>
                        <div class="overflow-hidden text-nowrap ">{{ item.description }}</div>
                    </div>
                </div>
            </li>

        </ul>

    </div>
</template>

<script>
    import { get, is_empty,getSelectorText, is_null,is_undefined } from '../../../helpers/customHelpers';
    import FormEquipoMedico from './FormEquipoMedico.vue';
    export default {
        data() {
            return {
                nombreIdModal: "doctorsListModal",
                //modal: document.getElementById(this.nombreIdModal),
                //modalJQ: $("#"+this.nombreIdModal),

                cat_items : [
                    {
                        id:[1],
                        grupos_medicos_to_show:[1],
                        description:"Tratante",
                        selector_description :function(){
                            return that.getSelectorText( this.description )
                        },
                        color:'success',
                        className:['fa-solid','fa-user-doctor'],
                        sigla(){return this.description.slice(0,2).toUpperCase()},
                        medicos_paciente:[],
                    },
                    {
                        id:[2],
                        grupos_medicos_to_show:[1,2],
                        description:"Interconsultante",
                        selector_description :function(){
                            return that.getSelectorText( this.description )
                        },
                        color:'info',
                        className:['fa-solid','fa-user-doctor'],
                        sigla(){return this.description.slice(0,2).toUpperCase()},
                        medicos_paciente:[],
                    },
                    {
                        id:[3,4],
                        grupos_medicos_to_show:[3,4],
                        description:"Fellow",
                        selector_description :function(){
                            return that.getSelectorText( this.description )
                        },
                        color:'orange',
                        className:['fa-solid','fa-user-doctor'],
                        sigla(){return this.description.slice(0,2).toUpperCase()},
                        medicos_paciente:[],
                    },
                    {
                        id:[5,6,7,8],
                        grupos_medicos_to_show:[5,6,7,8],
                        description:"Residente",
                        selector_description :function(){
                            return that.getSelectorText( this.description )
                        },
                        color:'secondary',
                        className:['fa-solid','fa-user-doctor'],
                        sigla(){return this.description.slice(0,2).toUpperCase()},
                        medicos_paciente:[],
                    },
                    {
                        id:[9],
                        grupos_medicos_to_show:[9],
                        description:"RAMH",
                        selector_description :function(){
                            return that.getSelectorText( this.description )
                        },
                        color:'purple',
                        className:['fa-solid','fa-user-doctor'],
                        sigla(){return this.description.slice(0,2).toUpperCase()},
                        medicos_paciente:[],
                    },
                    {
                        id:[10],
                        grupos_medicos_to_show:[10],
                        description:"Enfermería",
                        selector_description :function(){
                            return that.getSelectorText( this.description )
                        },
                        color:'warning',
                        className:['fa-solid','fa-user-nurse'],
                        sigla(){return this.description.slice(0,2).toUpperCase()},
                        medicos_paciente:[],
                    },
                ]

            }
        },
        components: {
            FormEquipoMedico,
        },
        props: {
            index_row:Number,
            dataPaciente:Object,
            medic_teem_patient: {
                type: Array,
                default: []
            },
            episodio_id: {
                type: Number,
                default: null
            },
            medic_teem_to_show: {
                type: Array,
                default: []
            }
        },
        methods: {
            modalColor(data){
                let modal = document.getElementById(this.nombreIdModal)
                //console.log(modal)
                //ELIMINAR TODOS LOS COLORES DE LA MODAL
                let colores = this.cat_items.map(x=> x.color)

                    colores.forEach(color=>{

                        modal.querySelector(".modal-header").classList.remove('bg-'+color)
                        //modal.querySelector("#total_result").classList.remove('text-'+color)

                        modal.querySelectorAll(".modal-footer button").forEach( (button,key)=>{
                            button.classList.remove('btn-'+color)

                        })

                    })
                //ASIGNAR NUEVO COLOR A LA MODAL
                //console.log(data);
                modal.querySelector(".modal-title").textContent= "Equipo "+data.group_cargo
                modal.querySelector(".modal-header").classList.add('bg-'+data.color)
                modal.querySelectorAll(".modal-footer button")[0].classList.add('btn-'+data.color)

                /*modal.querySelector("#total_result").classList.add('text-'+currentColor) */



            },
            handle_equipo_medico(event){
                //DESMONTAR EL COMPONENTE
                this.$store.commit('updateObjectValue', {
                    formName: 'componenteDinamico',
                    fieldName: 'customComponent2',
                    fieldValue: null
                });
                //PASAR DATOS AL COMPONENTE
                this.$store.commit('updateObjectValue', {
                    formName: 'componenteDinamico',
                    fieldName: 'dataGrupoMedico',
                    fieldValue: Object.assign({}, event.currentTarget.dataset)
                });
                //MONTAR EL COMPONENTE
                this.$store.commit('updateObjectValue', {
                    formName: 'componenteDinamico',
                    fieldName: 'customComponent2',
                    fieldValue: this.$options.components.FormEquipoMedico
                });


                this.modalColor(event.currentTarget.dataset)


                $("#"+this.nombreIdModal).modal("show")
            },
            getCurrentMedic( paramsArray ){
                return this.medic_teem_patient.find(item=> paramsArray.includes( Number(item['cat_user_medico_posicion_id']) )  )
            },
            getItems(){
                let resultset = []
                let medic_teem = []
                    if(this.medic_teem_to_show.length === 0){
                        this.medic_teem_to_show = [1,2,3,7,9,10]
                    }
                    this.medic_teem_to_show.forEach(id=>{
                        let result = this.cat_items.find(x=> x['id'].includes(id) )
                            if( !is_undefined( result ) ){
                                resultset.push(result)
                            }
                    })
                return resultset

            }
        },
        computed: {
            getComponenteDinamico2() {
                return this.$store.state.componenteDinamico2
            },
        },
        mounted () {

            //this.medic_teem_to_show = this.prop_medic_teem_to_show
            //$("#doctorsListModal").modal("show")
           /*  class MedicosPaciente {
                constructor({
                        attrSelectorId="doctorsList",
                        episode_id=null,
                        medic_teem_patient=[],//GUARDA LOS MEDICOS ASIGNADOS AL PACIENTE
                        medic_teem_to_show=[],//GUARDA LOS ID DE LOS GRUPOS DE MEDICOS A MOSTRAR EN LA TARJETA
                    }){
                        //console.log("MedicosPaciente episode_id",episode_id)
                    let that = this
                    this.episode_id = episode_id
                    //DATOS DE EPISODIO DEL PACIENTE
                    this.paciente = pacientes_datos.find(paciente=> equalsInt(paciente['episodio'],episode_id ) )
                    //INDICE EPISODIO EN EL OBJETO
                    this.episodio_index = pacientes_datos.findIndex(paciente=> equalsInt(paciente['episodio'],episode_id ) )
                    // MEDICOS QUE ATIENDEN AL PACIENTE
                    this.medic_teem_patient = this.paciente['medico_paciente']
                    //LISTA DE BOTONES DE MEDICOS A MOSTRAR
                    this.medic_teem_to_show = medic_teem_to_show
                    //ETIQUETA DONDE SE DESPLEGARÁ LA LISTA DE GRUPOS DE MEDICOS
                    this.selector = entById( attrSelectorId )
                    //CATALOGO DE CARGOS MEDICOS



                }

            } */
        },
    }

</script>

<style lang="scss" scoped>
.img-doctor{
    width:20px;
    height:20px;
    border-radius:20px;
}

</style>
