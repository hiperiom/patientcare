<template>
    <div class="d-flex flex-column">
        <div class="dropdown w-100 m-0">
            <button :class="['btn-link btn btn-block font-weight-bold border-0 dropdown-toggle d-flex align-items-center justify-content-center overflow-hidden','text-'+activeColor]" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <i class="pc-medico"></i> {{ title }}
            </button>
            <div @click="dropdownStop" class="dropdown-menu p-3" aria-labelledby="triggerId">
                <h6 :class="['dropdown-header','text-'+activeColor]">
                    <i class="pc-medico"></i> {{ title }}
                </h6>
                <div class="d-flex flex-column justify-content-between">
                    <input 
                        @keypress="filterValues()" 
                        :ref="'searchInput_'+component_name" 
                        type="text" 
                        class="form-control mb-1"
                    > <!-- -->
                    <div class="list-group overflow-auto" :ref="'myList_'+component_name" style="max-height:120px"  >
                        <a 
                            @click="handleAddPersonal(item.user_id)"
                            href="#" 
                            v-for="(item, index) in $store.state.personal_salud" :key="index"  
                            :data-user_id="item.user_id" 
                            :class="['list-group-item p-1 list-group-item-action',getActiveColor(item)]"
                        > 
                            {{item.medico}}
                        </a>
                    </div>
                   
                </div> 
            </div>
        </div>
        <ul class="list-group  list-group-flush p-0">
            <li 
                v-for="(item,index) in dataset" 
                :key="index" 
                class="list-group-item d-flex justify-content-between align-items-center p-0"
            >
                <div class="text-secondary">
                    {{ item.personal }}
                </div>
                <button 
                    :data-id="item.id" 
                    :data-index="index"  
                    @click="handleDestroyPersonal(item.id)" 
                    class="btn btn-default btn-sm ml-1 border-0 text-secondary">
                    &#128939;
                </button>
            </li>
            <li 
                v-if="dataset.length ===0" 
                class="list-group-item d-flex justify-content-center align-items-center text-gray p-0"
            >
                Sin seleccionar
            </li>
        </ul>
    </div>



</template>

<script>
    import { is_empty, is_undefined, post } from '../../../../../helpers/customHelpers';


    export default {
        props:[
            'component_name',
            'dataset',
            'activeColor',
            'title',
        ],
        name:"TodolistDropdownWithFilter",
       
        methods: {
            getActiveColor(item){
                return  this.dataset.map(x=> x['user_id']).includes(item.user_id) ? 'active-'+this.activeColor : '' 
            },
            async handleAddPersonal(user_id){

                let existeUser = this.dataset.some(x=>x['user_id'] === user_id  && x['tipo_personal'] === this.component_name && x['active'] === 1)
                    if(existeUser){
                        alert("Esta persona ya se encuentra agregada.")
                        return false
                    }

                let formData = new FormData();
                    formData.append("cat_quirofano_id",null)
                    formData.append("user_id",user_id)
                    formData.append("tipo_personal",this.component_name )
                    formData.append("_token", document.querySelector('meta[name="csrf-token"]').getAttribute('content') )

                let result = await post(location.origin + `/areaQuirofano/personal_asistencial/create`,formData)

                    this.$store.commit('updateOtroPersonalAsistencialEnfermeria', result);
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Personal asignado exitosamente.',
                        showConfirmButton: false,
                        timer: 1500
                    })
            },
            filterValues(){
                let searchInput = this.$refs["searchInput_"+this.component_name];
                let searchText = searchInput.value.toLowerCase();
                let listItems = this.$refs[`myList_`+this.component_name].querySelectorAll("a");
                    listItems.forEach(function(item) {
                        let itemText = item.textContent.toLowerCase();
                        item.style.display = itemText.includes(searchText) ? "block" : "none";
                    });

            },
           
            async handleDestroyPersonal(id){
                let formData = new FormData();
                    formData.append("id",id)
                    formData.append("field",'active' )
                    formData.append("value",0 )
                    formData.append("_token", document.querySelector('meta[name="csrf-token"]').getAttribute('content') )

                let result = await post(location.origin + `/areaQuirofano/personal_asistencial/destroy`,formData)

               
                    this.$store.commit('destroyOtroPersonalAsistencialEnfermeria', {
                        id: id,
                        tipo_personal: this.component_name,
                        field:'active',
                        value:0
                    });
                
            },
          
            
            dropdownStop(e){
                 e.stopPropagation();
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
        }
    }
</script>

<style lang="scss" scoped>

    .list-group > a.active-purple{
        z-index: 2;
        color: #ffffff;
        background-color: var(--purple);
        border-color: var(--purple);
    }
    .list-group > a.active-warning{
        z-index: 2;
        color: #ffffff;
        background-color: var(--warning);
        border-color: var(--warning);
    }
    .list-group > a.active-info{
        z-index: 2;
        color: #ffffff;
        background-color: var(--info);
        border-color: var(--info);
    }
    .btn-link:hover{
        background-color: rgb(236, 236, 236);
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
