<template>
    <!-- sidebar-right -->
    <div :class="['card border-0 m-0 my-1 show',getMaximize]" >
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-4 col-md-4 d-flex flex-column">
                    <TodolistDropdownWithFilter
                        
                        activeColor="warning"
                        title="PRE-ANESTESIA"
                        component_name="preanestesia"
                        :dataset="$store.state.otroPersonalAsistencial.filter(x=> x['tipo_personal'] === 'preanestesia' && x['active']===1 )"
                    />
                  
                </div>
                <div class="col-12 col-sm-4 col-md-4 d-flex flex-column">
                    <TodolistDropdownWithFilter
                        
                        activeColor="info"
                        title="RECUPERACIÓN"
                        component_name="recuperacion"
                        :dataset="$store.state.otroPersonalAsistencial.filter(x=> x['tipo_personal'] === 'recuperacion' && x['active']===1 )"
                    />

                </div>
                <div class="col-12 col-sm-4 col-md-4 d-flex flex-column">
                    <TodolistDropdownWithFilter
                        
                        activeColor="purple"
                        title="PRE Y POST OBSTÉTRICO / PEDIATRÍA"
                        component_name="obstetrico"
                        :dataset="$store.state.otroPersonalAsistencial.filter(x=> x['tipo_personal'] === 'obstetrico' && x['active']===1 )"
                    />

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { fechaDMA, get ,fechaAMD, meses, post, is_undefined, store_field } from '../../../../../helpers/customHelpers.js';
    import TodolistDropdownWithFilter from './TodolistDropdownWithFilter.vue';

    export default {
        components:{
            //TodolistDropdown,
            TodolistDropdownWithFilter,
           
        },
        data() {
            return {
                listadoQuirofanoEstaCargando:true,
            }
        },
        computed:{
            getMaximize(){
                return this.$store.state.maximize ==="true" ? 'fade-in-bottom' : 'fade-out-bottom'
            }
        },
        methods: {
            dropdownStop(e){
                 e.stopPropagation();
               // console.log(`${e.target.textContent} clicado!`);
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
        mounted: async function () {

                await this.getPersonalAsistencial();

        },
    }
</script>

<style lang="scss" scoped>
    .fade-in-bottom {
        -webkit-animation: fade-in-bottom 0.6s cubic-bezier(0.390, 0.575, 0.565, 1.000) both;
                animation: fade-in-bottom 0.6s cubic-bezier(0.390, 0.575, 0.565, 1.000) both;
    }
    @-webkit-keyframes fade-in-bottom {
    0% {
        -webkit-transform: translateY(50px);
                transform: translateY(50px);
        opacity: 0;
        display:none;
    }
    100% {
        -webkit-transform: translateY(0);
                transform: translateY(0);
        opacity: 1;
        display:block;
    }
    }
    @keyframes fade-in-bottom {
    0% {
        -webkit-transform: translateY(50px);
                transform: translateY(50px);
        opacity: 0;
        display:none;
    }
    100% {
        -webkit-transform: translateY(0);
                transform: translateY(0);
        opacity: 1;
        display:block;
    }
    }

    .fade-out-bottom {
        -webkit-animation: fade-out-bottom 0.7s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
                animation: fade-out-bottom 0.7s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
    }
    @-webkit-keyframes fade-out-bottom {
        0% {
            -webkit-transform: translateY(0);
                    transform: translateY(0);
            opacity: 1;
            display: block
        }
        100% {
            -webkit-transform: translateY(50px);
                    transform: translateY(50px);
            opacity: 0;
            display:none
        }
    }
    @keyframes fade-out-bottom {
        0% {
            -webkit-transform: translateY(0);
                    transform: translateY(0);
            opacity: 1;
            display: block;
        }
        100% {
            -webkit-transform: translateY(50px);
                    transform: translateY(50px);
            opacity: 0;
            display: none;
        }
    }

    .btn-link:hover{
            background-color: rgb(236, 236, 236);
        }
    .tbl-row-radius-left {
        border-top-left-radius: 10px;
        border-bottom-left-radius: 10px;
        border-left: 1px solid rgb(240, 240, 241);
        border-top: 1px solid rgb(240, 240, 241);
        border-bottom: 1px solid rgb(240, 240, 241);
    }
    .tbl-row-radius-right {
        border-top-right-radius: 10px;
        border-bottom-right-radius: 10px;
        border-right: 1px solid rgb(240, 240, 241);
        border-top: 1px solid rgb(240, 240, 241);
        border-bottom: 1px solid rgb(240, 240, 241);
    }
</style>
