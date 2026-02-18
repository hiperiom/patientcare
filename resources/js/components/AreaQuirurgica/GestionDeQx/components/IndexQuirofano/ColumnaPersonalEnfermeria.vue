<template>
    <div title="Pulsa en el texto para editar" class=" p-0 pl-1 ">

        <ul class="list-group  list-group-flush p-0">

            <li v-for="(item,index) in dataset" :key="index" class="list-group-item d-flex justify-content-between align-items-center p-0">
                <div class="text-secondary">{{ item.personal }} </div>
                <button :data-id="item.id" :data-index="index"  @click="handleDestroyPersonal(item.id)" class="btn btn-default btn-sm ml-1 border-0 text-secondary">&#128939;</button>
            </li>
           <li v-if="dataset.length ===0" class="list-group-item d-flex justify-content-center align-items-center text-gray p-0">
                Sin seleccionar
            </li>
        </ul>
    </div>
</template>

<script>
    import { post } from '../../../../../helpers/customHelpers';

    export default {
        props:[
            'dataset',
            'index',
            'estadoPropiedad',
            'tipo_personal',

        ],
        methods:{
            async handleDestroyPersonal(id){
                console.log(id,this.tipo_personal)
                let formData = new FormData();
                    formData.append("id",id)
                    formData.append("field",'active' )
                    formData.append("value",0 )
                    formData.append("_token", document.querySelector('meta[name="csrf-token"]').getAttribute('content') )

                let result = await post(location.origin + `/areaQuirofano/personal_asistencial/destroy`,formData)
                if(this.estadoPropiedad === "personalAsistencial"){
                    this.$store.commit('destroyPersonalAsistencialEnfermeria', {
                        index: this.index,
                        id: id,
                        tipo_personal: this.tipo_personal,
                        field:'active',
                        value:0
                    });
                }
                //console.log(result)
                if(this.estadoPropiedad === "otroPersonalAsistencial"){
                    this.$store.commit('destroyOtroPersonalAsistencialEnfermeria', {
                        id: id,
                        tipo_personal: this.tipo_personal,
                        field:'active',
                        value:0
                    });
                }

                //this.$store.state.personalAsistencial[ index ][field]

            },
        },
    }
</script>

<style lang="scss" scoped>

</style>
