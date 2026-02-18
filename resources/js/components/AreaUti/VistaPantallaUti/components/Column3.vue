<template>
    <!-- DIAS -->
    <td :style="'font-size: 1.8rem;width:2% !important;height:'+height" class="glassmod-effect text-center ">
        <div class="d-flex justify-content-center align-items-center" v-if="patient !== undefined" style="height: 100%;">
            {{ patient['dias'] }}
        </div>
    </td>
</template>

<script>
    import { mapState } from 'vuex';

    export default {
        name:"Column3",
        data() {
            return {
                patient: {},
            }
        },
        props: {
            ubication: Object,
            index: Number,
            height:{
                type: String,
                required: true,
                default: "auto",
            },
        },
   
        computed: {
            ...mapState(['pacientes_activos']),
          
        },
        watch: {
            pacientes_activos(newValue, oldValue) {
                if(this.ubication.cat_user_ubicacion_id === 391){
                    this.patient = this.ubication
                }else{
                    this.patient = this.pacientes_activos.find(x=>x.cat_user_ubicacion_id === this.ubication.id)
                }
            }
        },
        methods: {
         
        },
        mounted () {
            if(this.ubication.cat_user_ubicacion_id === 391){
                this.patient = this.ubication
            }else{
                this.patient = this.pacientes_activos.find(x=>x.cat_user_ubicacion_id === this.ubication.id)
            };
        },
    }
</script>

<style lang="scss" scoped>

</style>