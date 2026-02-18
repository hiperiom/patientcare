<template>
    <div >

        <div v-for="(item, index) in ObjectData" :key="'anestesiologo_'+index" class="d-flex rounded align-items-center shadow-sm mb-1">
            <div class="flex-shrink-1  btn-group">
                <button
                    :title="title"
                    :class="['btn mr-1 btn-outline-'+color+' text-nowrap font-weight-bold border-0 btn-sm px-1']"
                    type="button"
                    id="triggerId_anestesiologo"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                    style="font-size: 1rem;"
                >
                    <i class="fas fa-edit"></i>
                </button>
                <div @click="dropdownStop" class="dropdown-menu dropdown-menu-left p-1" aria-labelledby="triggerId">
                    <h6 :style="{'color':'var(--'+color+')'}" class="dropdown-header">
                        <i class="pc-medico"></i> {{title}}
                    </h6>
                    <div class="d-flex flex-column">


                        <input
                            @keypress="filterValues(index)"
                            :ref="'anestesiologo_'+index+user_id_paciente"
                            type="text"
                            class="form-control mb-1"
                        >

                        <div class="list-group overflow-auto" :id="'anestesiologo_List'+index+user_id_paciente" style="max-height:40vh">
                            <a
                                href="#"
                                v-for="(personal, index_personal) in $store.state.personal_salud"
                                :key="'anestesiologo_List_options'+index_personal"
                                :data-index="index"
                                :data-user_id="personal.user_id"
                                :data-description="personal.medico"
                                :class="['list-group-item p-1 list-group-item-action',{'active':getPersonalComputed.map(x=>x.user_id).includes(Number(personal.user_id))}]"
                            >
                                {{personal.medico}}
                            </a>

                        </div>

                    </div>
                </div>
            </div>
            <div class="flex-grow-1 pr-1">
                <ul class="list-group  list-group-flush p-0">
                   <li v-for="(item2,index2) in item" :key="index2" class="list-group-item  text-nowrap d-flex justify-content-between align-items-center p-0" >
                        <div class="text-secondary">
                            {{ item2.description }}
                        </div>
                       <button @click="handleDestroyPersonal(item2.id,index)" :data-id="item2.id" :data-index="index2"   class="btn btn-default btn-sm ml-1 border-0 text-secondary"><i class="fas fa-times"></i></button>
                    </li>
                   <li v-if="item.length === 0" class="list-group-item  text-nowrap d-flex align-items-center p-0" style="width: 200px;">


                    </li>
                </ul>

            </div>
        </div>

    </div>
</template>

<script>
    import { is_empty, is_undefined, post } from '../../../../../helpers/customHelpers';
    export default {
        props:[
            'index',
            'index2',
            'n_quirofano',
            'user_id_paciente',
            'solicitud_quirofano_id',

        ],
        name:"TodolistDropdownAnestesiologo",
        data(){
            return {
                siglas:"",
                color:'primary',
                title:"Anestesiólogo",
                name:"anestesiologo",
                user_id_medico:"",
                description:"",
                index_anestesiologo:"",
                formData:{

                },
            }
        },
        computed:{
            getPersonalComputed(){
                return this.getPersonal()
            },
            ObjectData(){

                let result =     JSON.parse(this.$store.state.listadoSolicitudesQx[this.index]['dias'][this.index2]['intervencion']).map(x=>x['anestesiologo'])

                return result
            },
        },
        methods: {
            filterValues(index){
                let searchInput = this.$refs["anestesiologo_"+index+this.user_id_paciente][0];

                    let searchText = searchInput.value.toLowerCase();


                    console.log(searchInput.value)
                    let listItems = document.querySelectorAll('#anestesiologo_List'+index+this.user_id_paciente+' a');
                        console.log(listItems)
                        listItems.forEach(function(item) {
                            let itemText = item.textContent.toLowerCase();
                            item.style.display = itemText.includes(searchText) ? "block" : "none";
                        });

            },
            getPersonal(){
                let quirofano = this.$store.state.personalAsistencial.find(x=>Number(x['id']) === Number(this.n_quirofano) )
                let personalAsistencial = []
                if ( !is_undefined(quirofano) && Object.hasOwnProperty.call(quirofano, 'personal_asistencial') ) {
                    personalAsistencial = quirofano['personal_asistencial'].filter(x=>x['tipo_personal'] === this.name && Number(x['solicitud_quirofano_id']) === Number(this.solicitud_quirofano_id)  && Number(x['active']) === 1 )
                }
                return personalAsistencial
            },
            async handleDestroyPersonal(id,index){
                //console.log(id,this.tipo_personal)
                /* let formData = new FormData();
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
                    }); */
                    /************/
                let items = JSON.parse(this.$store.state.listadoSolicitudesQx[this.index]['dias'][this.index2]['intervencion'])
                   console.log(items[index].anestesiologo);
                let newItems = items[index].anestesiologo.filter(x=>{
                        if(x['id'] !== Number(id)){
                            return x
                        }
                    })

                    items[index].anestesiologo = newItems
                    try {
                        let formData = new FormData();
                                formData.append("id",this.solicitud_quirofano_id)
                                formData.append("field",'intervencion')
                                formData.append("value",JSON.stringify(items) )
                                formData.append("_token", document.querySelector('meta[name="csrf-token"]').getAttribute('content') )

                        let result2 = await post(location.origin + `/areaQuirofano/update`,formData)
                            this.$store.commit('updateSolicitudQx2',[this.index,this.index2,'intervencion',JSON.stringify(items)])

                    } catch (error) {
                        console.log(error)
                    }

            },

            async handleAddPersonal(){
                let items = JSON.parse(this.$store.state.listadoSolicitudesQx[this.index]['dias'][this.index2]['intervencion'])
                    if(items[this.index_anestesiologo].anestesiologo.map(x=>x.id).includes(Number(this.user_id_medico)) ){
                        alert("Ya has seleccionado a esta persona")
                        this.user_id_medico = ""
                        return false
                    }
                    if(this.n_quirofano ===1000){
                        alert("Debes seleccionar un Quirófano antes de añadir anestesiologo.")
                        return false
                    }
                let newItems = items[this.index_anestesiologo].anestesiologo

                    newItems.push({
                        id:Number(this.user_id_medico),
                        description:this.description,
                    })
                    items[this.index_anestesiologo].anestesiologo = newItems
                console.log(items[this.index_anestesiologo].anestesiologo);

                    try {
                        let formData = new FormData();
                                formData.append("id",this.solicitud_quirofano_id)
                                formData.append("field",'intervencion')
                                formData.append("value",JSON.stringify(items) )
                                formData.append("_token", document.querySelector('meta[name="csrf-token"]').getAttribute('content') )

                        let result2 = await post(location.origin + `/areaQuirofano/update`,formData)
                            this.$store.commit('updateSolicitudQx2',[this.index,this.index2,'intervencion',JSON.stringify(items)])

                    } catch (error) {
                        console.log(error)
                    }
                /*



                 */



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
            let that = this
            this.ObjectData.forEach( (item,index)=>{
                document.querySelectorAll('#anestesiologo_List'+index+this.user_id_paciente+' a').forEach( (x)=>{
                    x.addEventListener("click",(e)=>{
                        that.user_id_medico = e.target.dataset.user_id
                        that.description = e.target.dataset.description
                        that.index_anestesiologo = e.target.dataset.index
                       //console.log(that);
                        that.handleAddPersonal()
                    })

                })
            })

//console.log(this.$refs["myList"+index+this.user_id_paciente][0]);



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
