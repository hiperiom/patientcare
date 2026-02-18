<template>
    <nav class="d-flex justify-content-between p-1">
        <ul id="list_areas" class="nav nav-pills" role="tablist">
            <li 
                @click="btn_getMenuAreas(1)" 
                :data-parent_cat_ubicaciones_id="$store.state.menuAreaActive" 
                class="d-none d-sm-block nav-item" 
                role="presentation"
            >
                <a 
                    title="Todos los Pacientes"
                    class="nav-link d-flex align-items-center active" 
                    id="pills-tp-tab" 
                    data-toggle="pill" 
                    href="#pills-tp" 
                    role="tab" 
                    aria-controls="pills-tp" 
                    aria-selected="true"
                >TP 
                <span class="ml-1 badge badge-white">{{$store.state.total_pacientes}}</span>
                </a>
            </li>
            <li 
                class="nav-item d-block d-sm-none" 
                role="presentation"
            >
                <div class="dropdown">
                    <button class="mr-1 btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    AREAS <span class="ml-1 badge badge-white">{{$store.state.episodios.length}}</span>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a 
                            @click="btn_getMenuAreas(item['id'])"  
                            :data-parent_cat_ubicaciones_id="item['id']" 
                            v-for="(item,index) in showMenuAreas" 
                            :key="index" 
                            class="dropdown-item text-uppercase" 
                            href="#"
                        >
                            {{item['coments']}} 
                            <span class="ml-1 badge badge-white">{{$store.state.total_pacientes}}</span>
                        </a>
                    
                    </div>
                </div>
                
            </li>
            <li 
                @click="btn_getMenuAreas(item['id'])" 
                :data-parent_cat_ubicaciones_id="item['id']" 
                v-for="(item,index) in showMenuAreas" 
                :key="index" 
                class="d-none d-sm-block text-uppercase nav-item" 
                role="presentation"
            >
                <a 
                    :title="item['name']"
                    class="nav-link d-flex align-items-center" 
                    :id="'pills-'+item['id']+'-tab'" 
                    :href="'#pills-'+item['id']"
                    :aria-controls="'pills-'+item['id']"
                    data-toggle="pill" 
                    role="tab"  
                    aria-selected="true"
                >
                {{item['coments']}}
                <span class="ml-1 badge badge-white">{{$store.state.total_pacientes}}</span>
                </a>
            </li>
          
        </ul>
        <div class="d-flex align-items-center">
            <button id="menu-toggle-right" class="btn btn-outline-primary text-uppercase mr-1">Altas</button>
            <input ref="busquedapaciente" class="form-control mr-2" type="search" placeholder="Buscar un paciente..." aria-label="Search">
            <button @click="btn_sidebarRight" id="menu-toggle-right" class="d-none btn btn-outline-primary mr-1"><i class="fas fa-bars"></i></button>
            <button class="btn btn-success text-nowrap">Nuevo Paciente</button>
        </div>
        
    </nav>
</template>

<script>
    import { get, is_empty, is_null,is_undefined } from '../../helpers/customHelpers.js';
    export default {
        name:"Navbar2",
        props:{
            getMenuAreas: Function
        },
        computed: {
            showMenuAreas(){
                return this.$store.state.menuAreaActive
            },
        },
        methods:{
            btn_getMenuAreas(parent_id=1){
                this.getMenuAreas(parent_id)
            },
            btn_sidebarRight(){
                if (localStorage.getItem('sidebarRight') ==="true") {
                    localStorage.setItem('sidebarRight',"false")
                } else {
                    localStorage.setItem('sidebarRight',"true")
                }
                this.$store.state.sidebarRight = JSON.parse(localStorage.getItem('sidebarRight'))
            },
        },

        async mounted() {
            
           
        },
    }
</script>

<style lang="scss" scoped>

</style>