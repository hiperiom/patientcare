<template>
    <div id="sidebar-right" :class="{'sidebar-right shadow flex-shrink-1 mx-1 show d-flex flex-column':true}"  style="height: 76vh;background-color: white;padding: 0 0.5rem;border-radius: 1rem;">
        <div class="d-flex align-items-start flex-column overflow-auto">
            <div class="p-1 w-100 mb-auto "  >
                <table class="table table-bordered" style="border-radius: 20px;border-collapse: separate;border: solid var(--gray) 0px;">
                    <thead>
                        <tr>
                            <th class="text-center text-primary" colspan="4">PERSONAL DE ENFERMERIA</th>
                        </tr>
                        <tr  class="text-center bg-primary">
                            <th class="text-nowrap p-1">Qx</th>
                            <th class="text-nowrap p-1">C. ANESTESIA</th>
                            <th class="text-nowrap p-1">C. CIRUGÍA</th>
                            <th class="text-nowrap p-1">INSTRUM</th>

                        </tr>
                    </thead>
                    <tbody id="personal_asistencial">
                        <tr v-if="listadoQuirofanoEstaCargando">
                            <td  colspan="4">
                                <div class="d-flex my-2 justify-content-center align-items-center">
                                    <strong class="text-primary">Buscando Quirófanos...</strong>
                                    <div class="ml-1 spinner-border text-primary" role="status" aria-hidden="true"></div>
                                </div>
                            </td>
                        </tr>
                        <tr v-for="(quirofano,indexQuirofano) in $store.state.personalAsistencial" :key="indexQuirofano">
                            <td class="btn-link text-uppercase text-nowrap font-weight-bold p-0 pl-1" :style="{'vertical-align': 'middle'}">
                                <TodolistDropdown
                                    :btnText="quirofano.description"
                                    :textColor="quirofano.backgroundColor"
                                    :dropdownHeader="['C. Anestesia','C. Cirugía','Instrumentista',]"
                                    :selectOptions1="$store.state.personal_salud.filter(x=>x['equipo_salud']==='Circulante Anestesia')"
                                    :selectOptions2="$store.state.personal_salud.filter(x=>x['equipo_salud']==='Circulante Cirugía')"
                                    :selectOptions3="$store.state.personal_salud.filter(x=>x['equipo_salud']==='Instrumentista')"
                                    tipo_personal1="c_anestesia"
                                    tipo_personal2="c_cirugia"
                                    tipo_personal3="instrumentista"
                                    color_personal1="text-primary"
                                    color_personal2="text-success"
                                    color_personal3="text-secondary"
                                    estadoPropiedad="personalAsistencial"
                                    :cat_quirofano_id="quirofano.id"
                                    :quirofano_index="indexQuirofano"
                                />


                            </td>

                            <ColumnaPersonalEnfermeria
                                :index="indexQuirofano"
                                tipo_personal="c_anestesia"
                                estadoPropiedad="personalAsistencial"
                                :dataset="quirofano.personal_asistencial.filter(x=>x['tipo_personal']==='c_anestesia'&& Number(x['active'])===1)"
                            />
                            <ColumnaPersonalEnfermeria
                                :index="indexQuirofano"
                                tipo_personal="c_cirugia"
                                estadoPropiedad="personalAsistencial"
                                :dataset="quirofano.personal_asistencial.filter(x=>x['tipo_personal']==='c_cirugia'&& Number(x['active'])===1)"
                            />
                            <ColumnaPersonalEnfermeria
                                :index="indexQuirofano"
                                tipo_personal="instrumentista"
                                estadoPropiedad="personalAsistencial"
                                :dataset="quirofano.personal_asistencial.filter(x=>x['tipo_personal']==='instrumentista'&& Number(x['active'])===1)"
                            />
                        </tr>
                    </tbody>

                </table>
            </div>
            <div class="p-1 w-100" style="background-color: #fbfbfb;" >
                <table class="table table-bordered" style="border-collapse: collapse !important;    border-spacing: 0px 0px  !important;">
                    <thead>

                        <tr  class="text-center bg-primary">
                            <th class="text-nowrap p-1 "></th>
                            <th class="text-nowrap p-1">PREANESTESIA</th>
                            <th class="text-nowrap p-1">RECUPERACION</th>
                            <th class="text-nowrap p-1 ">PRE Y POST OBST / PED</th>
                        </tr>
                    </thead>
                    <tbody id="personal_asistencial">
                        <tr>
                            <td class="btn-link text-center text-uppercase text-nowrap font-weight-bold p-0 pl-1" :style="{'vertical-align': 'middle','width':'84px'}">
                                <TodolistDropdown
                                    :btnText="'≣'"
                                    :textColor="'var(--primary)'"
                                    :dropdownHeader="['Pre-anestesia','Recuperación','Pre y Post Obst / Ped']"
                                    :selectOptions1="$store.state.personal_salud.filter(x=>['Instrumentista','Circulante Anestesia','Circulante Cirugía'].includes( x['equipo_salud']) )"
                                    :selectOptions2="$store.state.personal_salud.filter(x=>['Instrumentista','Circulante Anestesia','Circulante Cirugía'].includes( x['equipo_salud']) )"
                                    :selectOptions3="$store.state.personal_salud.filter(x=>['Instrumentista','Circulante Anestesia','Circulante Cirugía'].includes( x['equipo_salud']) )"
                                    tipo_personal1="preanestesia"
                                    tipo_personal2="recuperacion"
                                    tipo_personal3="obstetrico"
                                    color_personal1="text-secondary"
                                    color_personal2="text-secondary"
                                    color_personal3="text-secondary"
                                    estadoPropiedad="otroPersonalAsistencial"
                                    :cat_quirofano_id="null"
                                    :quirofano_index="null"
                                />


                            </td>
                            <ColumnaPersonalEnfermeria
                                :index="null"
                                tipo_personal="preanestesia"
                                estadoPropiedad="otroPersonalAsistencial"
                                :dataset="$store.state.otroPersonalAsistencial.filter(x=>x['tipo_personal']==='preanestesia' && x['active']===1)"
                            />
                            <ColumnaPersonalEnfermeria
                                :index="null"
                                tipo_personal="recuperacion"
                                estadoPropiedad="otroPersonalAsistencial"
                                :dataset="$store.state.otroPersonalAsistencial.filter(x=>x['tipo_personal']==='recuperacion' && x['active']===1)"
                            />
                            <ColumnaPersonalEnfermeria
                                :index="null"
                                tipo_personal="obstetrico"
                                estadoPropiedad="otroPersonalAsistencial"
                                :dataset="$store.state.otroPersonalAsistencial.filter(x=>x['tipo_personal']==='obstetrico' && x['active']===1)"
                            />

                        </tr>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</template>

<script>
    import { fechaDMA, get ,fechaAMD, meses, post, is_undefined, store_field } from '../../../../../helpers/customHelpers.js';
import ColumnaPersonalEnfermeria from './ColumnaPersonalEnfermeria.vue';
    import TodolistDropdown from './TodolistDropdown.vue';
    export default {
        components:{
    TodolistDropdown,
    ColumnaPersonalEnfermeria
},
        data() {
            return {
                listadoQuirofanoEstaCargando:true,
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
                    let model = await get(location.origin + '/areaQuirofanoAmb/personal_asistencial/gelAll' )

                        this.$store.commit('updatePersonalAsistencial',model)

                        model = await get(location.origin + '/areaQuirofanoAmb/personal_asistencial/gelAllOtroPersonal' )
                        this.$store.commit('updateOtroPersonalAsistencial',model)


                    this.listadoQuirofanoEstaCargando =false
                } catch (error) {
                    this.listadoQuirofanoEstaCargando =false
                    console.error('Error al obtener los datos:', error);
                    return []
                }
            },
            handleShowMenu(){
                let sidebarRight = document.getElementById("sidebar-right");
                let content = document.getElementById("content");
                let showMenu = localStorage.getItem("showMenu")

                let showMenuRight = localStorage.getItem("showMenuRight")

                if (showMenuRight==="true") {
                    sidebarRight.classList.add("show");
                    //content.classList.add("hide");
                    localStorage.setItem('showMenuRight',"false")
                } else {
                    sidebarRight.classList.remove("show");
                    //content.classList.remove("hide");
                    localStorage.setItem('showMenuRight',"true")
                }

            },
        },
        mounted: async function () {
            let sidebarRight = document.getElementById("sidebar-right");
            //console.log(sidebarRight)

            //let showMenu = localStorage.getItem("showMenu")

            let showMenuRight = localStorage.getItem("showMenuRight")

                if (showMenuRight==="true") {
                    sidebarRight.classList.remove("show");
                } else {
                    sidebarRight.classList.add("show");
                }
            let that = this
                document.querySelector("#btn-sidebar-right").addEventListener("click", function(e) {

                    e.preventDefault();
                    that.handleShowMenu()
                });

                //await this.getPersonalAsistencial();

        },
    }
</script>

<style lang="scss" scoped>
/* :root {
    --radius-table-row: 10px;
     --table-border-row-color: rgb(240, 240, 241);
}*/
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
