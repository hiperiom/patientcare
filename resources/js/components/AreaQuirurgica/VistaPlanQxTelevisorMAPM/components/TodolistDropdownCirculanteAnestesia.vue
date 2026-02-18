<template>
    <div class="d-flex rounded align-items-center">
        <ul class="list-group  list-group-flush p-0">
            <li v-for="(item,index) in getPersonalComputed" :key="index" class="list-group-item font-weight-normal bg-transparent  text-nowrap d-flex justify-content-between align-items-center  p-0 pl-1" >
                 <div class="text-white d-flex align-items-center" style="font-size: 0.8rem;">
                     <span :class="['font-weight-bold mr-1']" style="width: 15px;">{{siglas}}</span>

                     <div class="d-flex  align-items-center">
                        <img
                            loading="lazy"
                            onerror="this.src='/image/system/patient.svg'"
                            :src="getImagen(item.user_id)"
                            class="img-doctor mr-1"
                            :style="'width: 15px; height: 15px; border-radius: 20px;'"
                        >
                        <div>
                            {{ item.personal }}
                        </div>
                     </div>

                 </div>
            </li>
            <!-- <li v-if="getPersonalComputed.length === 0" class="list-group-item bg-transparent text-nowrap d-flex align-items-center p-0 pl-1" style="width: 200px;">
                 <div :class="['text-white']">
                     <span class="font-weight-bold mr-1" style="font-size: 1rem;">{{siglas}}</span>
                 </div>
             </li> -->
         </ul>
    </div>
</template>

<script>
    import { is_empty, is_undefined, post } from '../../../../helpers/customHelpers.js';
    export default {
        props:[
            'n_quirofano',
            'user_id_paciente',
            'solicitud_quirofano_id',
            'solicitud',
        ],
        name:"TodolistDropdownInstrumentista",
        data(){
            return {
                siglas:"CA",
                color:'success',
                title:"Circulante Anestesia",
                name:"c_anestesia",
                user_id_medico:"",
                formData:{

                },
            }
        },
        computed:{
            getPersonalComputed(){
                return JSON.parse(this.solicitud.personal_asistencial).filter(x=>x.tipo_personal===this.name && x.active===1)
            },
            ObjectData(){
                return JSON.parse(this.$store.state.formReservacionQuirofano[ this.tagValueText ])
            },

        },
        methods: {
            getImagen(user_id){
                let medico = this.$store.state.listadoEquipoCirugia.find(x=>x.user_id===user_id)
                return is_undefined(medico)?"#":medico['imagen']
            },
            getPersonal(){

                let quirofano = this.$store.state.personalAsistencial.find(x=>Number(x['id']) === Number(this.n_quirofano) )
                //console.log(quirofano)
                let personalAsistencial = quirofano['personal_asistencial'].filter(x=>x['tipo_personal'] === this.name && Number(x['solicitud_quirofano_id']) === Number(this.solicitud_quirofano_id)  && Number(x['active']) === 1 )
                return personalAsistencial
            },



            childRef() {
                return this.$refs[ 'input_'+this.tagValueText ] ;
            },


        },
        mounted(){

        }
    }
</script>

<style lang="scss" scoped>
    .btn-link:hover{
        background-color: rgb(236, 236, 236);
    }
    .btn-outline-gray {
        color: var(--gray);
        border-color: var(--gray);
    }
    .btn-outline-gray:hover {
        color: #ffffff;
        background-color: var(--gray);
        border-color: var(--gray);
    }
    .btn-purple {
        color: white;
        background-color: var(--purple);
        border-color: var(--purple);
        box-shadow: none;
    }
    .list-group-item-empty{
        position: relative;
        display: block;
        background-color: transparent;
        /*border: 2px dashed rgba(0, 0, 0, 0.125);*/
        text-align: center;
        color: var(--secondary);
        border-radius: 0.25rem;
    }
</style>
