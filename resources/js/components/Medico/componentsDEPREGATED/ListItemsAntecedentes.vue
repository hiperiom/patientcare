<template>
    <div class="table-responsive">
        <table class="table table-bordered mb-3">
            <thead>
                <tr>
                    <th class="text-primary text-center">
                        #
                    </th>
                    <th class="text-primary text-center">Antecedentes/Comorbilidad de Egreso</th>
                    <th class="d-none text-primary text-center">Acción</th>

                </tr>
            </thead>
            <tbody v-if="items.length > 0">
                <tr v-for="(item,index) in items" :key="index">
                    <td style="width: 20px;" class="text-right text-secondary" id="modal-793">
                        {{ index+1 }}
                    </td>
                    <td class="text-secondary" id="modal-793">
                        {{ item.description }}
                    </td>
                    <td class="d-none" style="width: 60px;" align="center">
                        <button  data-tippy-content="Eliminar valor" class="delete-row btn btn-danger" data-id="793"><i class="fa fa-minus" aria-hidden="true"></i></button>
                    </td>
                </tr>
            </tbody>
            <tbody v-else>
                <tr>
                    <td colspan="3" class="text-center text-primary">
                        No se encontraron resultados
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import { get, post,is_empty,obtenerVariablesGET,  is_null,is_undefined } from '../../../helpers/customHelpers';
export default {
    name:"ListItemsAntecedentes",
    props:{
        currentResult:Array,
        index_row:Number,
        dataPaciente:Object
    },
    components: {

    },
    data() {
        return {
            items:[]
        }
    },
    methods:{
        async getItems(){
            let formdata = new FormData();
                formdata.append("_token", $("#_token").val())
                formdata.append("user_id", this.dataPaciente.user_id)
                this.items =  await post(location.origin+"/user_cuest_comorbilidad/show/"+this.dataPaciente.user_id, formdata)
        }
    },
    mounted(){
        this.getItems()
    }
}
</script>

<style scoped>


</style>
