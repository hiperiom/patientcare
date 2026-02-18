<template>
    <div class="d-flex rounded align-items-center shadow-sm mb-1">
        <div class="flex-shrink-1  btn-group">
            <button
                :title="title"
                :class="['btn  mr-1 btn-outline-'+color+' text-nowrap font-weight-bold border-0 btn-sm px-1']" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false" style="font-size: 1rem;">
                <i class="pc-medico"></i>
            </button>
            <div @click="dropdownStop" class="dropdown-menu dropdown-menu-left p-1" aria-labelledby="triggerId">
                <h6 :style="{'color':'var(--'+color+')'}" class="dropdown-header"><i class="pc-medico"></i> {{title}}</h6>
                <div class="d-flex flex-column">


                    <input @keypress="filterValues()" :ref="'searchInput'+user_id_paciente" type="text" class="form-control mb-1">

                    <div class="list-group overflow-auto" :ref="'myList'+user_id_paciente" style="max-height:40vh">
                        <a href="#" v-for="(personal, index_personal) in $store.state.personal_salud" :key="index_personal" :data-user_id="personal.user_id" :class="['list-group-item p-1 list-group-item-action',{'active':getPersonalComputed.map(x=>x.user_id).includes(Number(personal.user_id))}]"> {{personal.medico}}</a>

                    </div>

                </div>
            </div>
        </div>
        <div class="flex-grow-1 pr-1">
            <ul class="list-group  list-group-flush p-0">
               <li v-for="(item,index) in getPersonalComputed" :key="index" class="list-group-item  text-nowrap d-flex justify-content-between align-items-center p-0" >
                    <div class="text-secondary">
                        <span :class="['font-weight-bold mr-1 text-'+color]" style="font-size: 1rem;">{{siglas}}</span>
                        {{ item.personal }}
                    </div>
                   <button @click="handleDestroyPersonal(item.id,index)" :data-id="item.id" :data-index="index"   class="btn btn-default btn-sm ml-1 border-0 text-secondary">&#128939;</button>
                </li>
               <li v-if="getPersonalComputed.length === 0" class="list-group-item  text-nowrap d-flex align-items-center p-0" style="width: 200px;">
                    <div :class="['text-'+color]">
                        <span class="font-weight-bold mr-1" style="font-size: 1rem;">{{siglas}}</span>
                    </div>

                </li>
            </ul>

        </div>
    </div>
</template>

<script>
    import { is_empty, is_undefined, post } from '../../../../../helpers/customHelpers';
    export default {
        props:[
            'n_quirofano',
            'user_id_paciente',
            'solicitud_quirofano_id',
        ],
        name:"TodolistDropdownCirculanteCirugia",
        data(){
            return {
                siglas:"CC",
                color:'primary',
                title:"Circulante Cirugía",
                name:"c_cirugia",
                user_id_medico:"",
                formData:{

                },
            }
        },
        computed:{
            getPersonalComputed(){
                return this.getPersonal()
            },
            ObjectData(){
                return JSON.parse(this.$store.state.formReservacionQuirofano[ this.tagValueText ])
            },

        },
        methods: {
            filterValues(){
                let searchInput = this.$refs["searchInput"+this.user_id_paciente];

                    let searchText = searchInput.value.toLowerCase();
                    let listItems = this.$refs[`myList${this.user_id_paciente}`].querySelectorAll("a");
                        //console.log(listItems)
                        listItems.forEach(function(item) {
                            let itemText = item.textContent.toLowerCase();
                            item.style.display = itemText.includes(searchText) ? "block" : "none";
                        });

            },
            getPersonal(){
                let quirofano = this.$store.state.personalAsistencial.find(x=>Number(x['id']) === Number(this.n_quirofano) )
                let personalAsistencial = quirofano['personal_asistencial'].filter(x=>x['tipo_personal'] === this.name && Number(x['solicitud_quirofano_id']) === Number(this.solicitud_quirofano_id)  && Number(x['active']) === 1 )
                return personalAsistencial
            },
            async handleDestroyPersonal(id,index){
                //console.log(id,this.tipo_personal)
                let formData = new FormData();
                    formData.append("id",id)
                    formData.append("field",'active' )
                    formData.append("value",0 )
                    formData.append("_token", document.querySelector('meta[name="csrf-token"]').getAttribute('content') )

                let result = await post(location.origin + `/areaQuirofano/personal_asistencial/destroy`,formData)
                let indexQuirofano = this.$store.state.personalAsistencial.findIndex(x=>x['id']===this.n_quirofano)
                    this.$store.commit('destroyPersonalAsistencialEnfermeria', {
                        index: indexQuirofano,
                        id: id,
                        tipo_personal: this.name,
                        field:'active',
                        value:0
                    });

                //this.$store.state.personalAsistencial[ index ][field]

            },
            async handleAddPersonal(){

                if(this.getPersonalComputed.map(x=>x.user_id).includes(Number(this.user_id_medico)) ){
                    alert("Ya has seleccionado a esta persona")
                    this.user_id_medico = ""
                    return false
                }
                try {
                    let formData = new FormData();
                        formData.append("cat_quirofano_id",this.n_quirofano)
                        formData.append("user_id",this.user_id_medico)
                        formData.append("tipo_personal",this.name )
                        formData.append("solicitud_quirofano_id",this.solicitud_quirofano_id )
                        formData.append("_token", document.querySelector('meta[name="csrf-token"]').getAttribute('content') )

                    let result = await post(location.origin + `/areaQuirofano/personal_asistencial/create`,formData)

                    let newData = this.$store.state.personalAsistencial.find(x=>x['id']===this.n_quirofano)['personal_asistencial'].filter(x=>{
                       // console.log(x['user_id'],this.user_id_medico)
                        if(x['user_id'] === this.user_id_medico){
                            x.active = 0
                        }
                        return x
                    })
                    //console.log(newData)
                    let peronalAsistencial = this.$store.state.personalAsistencial.findIndex(x=>x['id']===this.n_quirofano)

                    let indexQuirofano = this.$store.state.personalAsistencial.findIndex(x=>x['id']===this.n_quirofano)
                        this.$store.commit('updatePersonalAsistencialQx', {
                            index: indexQuirofano,
                            value:newData
                        });
                        this.$store.commit('updatePersonalAsistencialEnfermeria', {
                            index: indexQuirofano,
                            value:result
                        });
                        this.user_id_medico=""

                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Personal asignado exitosamente.',
                            showConfirmButton: false,
                            timer: 1500
                        })

                } catch (error) {
                    console.log(error)
                }



            },

            dropdownStop(e){
                 e.stopPropagation();
               // console.log(`${e.target.textContent} clicado!`);
            },
            childRef() {
                return this.$refs[ 'input_'+this.tagValueText ] ;
            },
            updateFormField(event) {
                this.$store.commit('updateFormField', {
                    formName:"formReservacionQuirofano",
                    fieldName:event.currentTarget.name,
                    fieldValue:event.currentTarget.value,
                });
            },

        },
        mounted(){
           this.$refs["myList"+this.user_id_paciente].addEventListener("click",(e)=>{
                this.user_id_medico = e.target.dataset.user_id
                this.handleAddPersonal()
            })
        }
    }
</script>
 
<style lang="scss" scoped>
    .btn-link:hover{
        background-color: rgb(236, 236, 236);
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
