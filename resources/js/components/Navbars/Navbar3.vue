<template>
    <nav class="d-flex justify-content-between p-1">
        <div class="d-flex align-items-center">
            <div class="dropdown mr-1">
                <button class="btn btn-outline-primary " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    &#xa9;
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <h6 class="dropdown-header text-primary">Ver pacientes por:</h6>
                    <a class="dropdown-item" href="#">Seguimiento Médico</a>
                    <a class="dropdown-item" href="#">Signos Vitales</a>
                </div>
            </div>
            <h3 class="text-primary overflow-hidden text-nowrap mb-0">{{$store.state.titleAreaActual}}</h3>
        </div>
        <ul id="list_totales" class="nav nav-pills" role="tablist">
            
            <li v-for="(item,index) in $store.state.groupBtnTotales" :key="index" class="d-none d-sm-block text-uppercase nav-item" role="presentation">
                <a 
                    title="item['name']"
                    class="nav-link d-flex align-items-center" 
                    id="'pills-'+item['id']+'-tab'" 
                    href="'#pills-'+item['id']"
                    aria-controls="'pills-'+item['id']"
                    data-toggle="pill" 
                    role="tab"  
                    aria-selected="true"
                >
                &#xa9;
                <span class="ml-1 badge badge-white">000</span>
                </a>
            </li>
            
           
          
        </ul>
        
        
    </nav>
</template>

<script>
    import { get, is_empty, is_null,is_undefined } from '../../helpers/customHelpers.js';
    export default {
        name:"Navbar3",
        computed: {
            /* showMenuAreas(){
                return this.$store.state.menuAreaActive
            }, */
        },
        methods:{
            /* btn_sidebarRight(){
                if (localStorage.getItem('sidebarRight') ==="true") {
                    localStorage.setItem('sidebarRight',"false")
                } else {
                    localStorage.setItem('sidebarRight',"true")
                }
                this.$store.state.sidebarRight = JSON.parse(localStorage.getItem('sidebarRight'))
            }, */
        },
    }
</script>

<style lang="scss" scoped>

</style>