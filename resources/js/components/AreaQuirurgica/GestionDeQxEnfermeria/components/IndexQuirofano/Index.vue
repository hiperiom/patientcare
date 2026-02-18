<template>
  <!-- bg-gray-1  -->
  <div class="flex-grow-1 d-flex flex-column overflow-auto" id="content">
    <div class="flex-fill  container-fluid d-flex flex-column overflow-auto">
      <div class="d-flex py-2 flex-column flex-sm-row align-items-center  align-items-sm-center justify-content-center justify-content-sm-between">
          <div class="title-option-page text-primary mb-0">{{$route.name}}</div>
          <div class="d-flex">
              <button @click="maximize" title="Simplificar visualización" :class="['mt-1 mr-1 mt-sm-0 btn',{'btn-outline-secondary':!getMaximize},{'btn-outline-primary':getMaximize} ]"><i :class="['fas ',{'fa-compress-alt':!getMaximize},{'fa-expand-alt':getMaximize} ]"></i></button>
              <router-link target="_blank" class="btn btn-success mt-1 mr-1 mt-sm-0" to="/areaQuirofano/externo/iqx">Plan Quirúrgico</router-link>

          </div>
        </div>
       
        <ColumnaIzquierda />
        <CintilloInferior />
    </div>

  </div>
</template>

<script>

    //import tippy from 'tippy.js';
    //import 'tippy.js/dist/tippy.css'; // Importa los estilos de Tippy.js
    import { fechaDMA, get ,fechaAMD, meses, post, is_undefined, store_field } from '../../../../../helpers/customHelpers.js';
    import CintilloSuperior from './CintilloSuperior.vue?0001';
    import ColumnaIzquierda from './ColumnaIzquierda.vue?0001';
    import CintilloInferior from './CintilloInferior.vue?0001';
    export default {
        components:{
            //TodolistDropdown,
            CintilloSuperior,
            //ColumnaDerecha,
            ColumnaIzquierda,
            CintilloInferior,
        },
        computed:{
          getMaximize(){
            return this.$store.state.maximize ==="true" ? true : false
          }
        },
        data() {
            return {

                edad: 0,
                numeros: Array.from({ length: 24 }, (_, index) => index + 1), // Genera un arreglo con números del 1 al 24
            };
        },
        methods: {
            maximize(){
              if (this.$store.state.maximize =="true") {
                localStorage.setItem("maximize","false")
              }else{
                localStorage.setItem("maximize","true")
              }
              this.$store.commit('updateProperty', {
                  fieldName:'maximize',
                  fieldValue:localStorage.getItem("maximize"),
              });

            },
            async handleEnfermeria(index,field){
                /* let button = e.target
                let {input_name,reservacion_id,index,index2} = button.dataset
                let input_value = document.querySelector(`#${input_name+reservacion_id}`)
                let selectedOption = input_value.options[input_value.selectedIndex];

                let temp_object = {
                            "id": selectedOption.value,
                            "description": selectedOption.text,
                        }
                //console.log(JSON.stringify(temp_object))
                this.handleRegProgramacion(
                    '¿Deseas actualizar el personal asistencial?',
                    input_name,
                    JSON.stringify(temp_object),
                    reservacion_id,
                    index2,
                    index
                ) */




                /* let row = this.$store.state.personalAsistencial[index]
                //console.log(this.$store.state.personalAsistencial[index])
                let formData = new FormData();
                        formData.append("id",row.id)
                        formData.append("field",field)
                        formData.append("value",this.$store.state.personalAsistencial[ index ][field] )
                        formData.append("_token", document.querySelector('meta[name="csrf-token"]').getAttribute('content') )

                    let result2 = await post(location.origin + `/areaQuirofano/personal_asistencial/update`,formData) */
                    //console.log(result2)
            },
            getMedico(id){
                let model = this.$store.state.equipo_medico.find(x=>Number(x['user_id']) ===Number(id))
                //console.log(model)
                return is_undefined(model) ? 'Seleccione' : model.medico
            },
        },


        mounted: async function () {

                this.$store.commit('updateEspecialidadesUnicas')

        },

    }

</script>

<style>
  .vh-100{
    height: 100vh;
  }

  /*// Small devices (landscape phones, 576px and up)*/
  @media (min-width: 576px) {

  }

  /*// Medium devices (tablets, 768px and up)*/
  @media (min-width: 768px) {

  }

  /*// Large devices (desktops, 992px and up)*/
  @media (min-width: 992px) {

  }

  /*// Extra large devices (large desktops, 1200px and up)*/
  @media (min-width: 1200px) {

  }
    .sidebar {
        width: 0px;
        transform: translateX(100%);
        visibility: hidden;
        opacity:0;
        transition: width 0.5s,opacity 0.5s;
        padding-left: 0;
        padding-right: 0;
    }
    .sidebar-right {
        width: 0px;
        transform: translateX(-2000%);
        visibility: hidden;
        opacity:0;
        transition: width 0.5s,opacity 0.5s;
        padding-left: 0px;
        padding-right: 0px;
    }

    .sidebar-right.show {
        visibility: visible;
        width: auto;
        transform: translateX(0%);
        opacity:1;
    }
    #personal_asistencial .btn-default {
        background-color: transparent ;
        border-color: #ddd;
        color: #444;
    }
    #personal_asistencial .btn-default:hover {
        background-color: var(--gray) ;
        border-color: var(--gray) ;
        color: var(--primary);
        font-weight: 600;
    }
    .vh-columnas{
        height: 76vh;
    }

    table {

        border-collapse: separate !important;
        border-spacing: 0px 10px;
        /* Espaciado vertical entre filas */
    }
    .btn-rounded-pill-custom {
        border-radius: 19px !important;
    }
    .btn-primary-custom{
        color: #ffffff;
        background-color: #5b96df !important;
    }
    .sticky{
        position: sticky;
        top: 0px;
    }
    .valign-center{
        vertical-align: middle;
    }
    .bg-gray-1 {
        /*background-color: #F6F8FC !important;*/
        background-color: #F6F8FC !important;
    }
    .tbl-row-radius-left {
        border-top-left-radius: 10px;
        border-bottom-left-radius: 10px;
    }
    .tbl-row-radius-right {
        border-top-right-radius: 10px;
        border-bottom-right-radius: 10px;
    }
    .corner-radius-top-left {
        border-top-left-radius: 10px;
    }

    .corner-radius-bottom-left {
        border-bottom-left-radius: 10px;
    }
    .hidden-row {
      display: none;
    }

    .shadow-drop-bottom:hover,
    .shadow-drop-bottom:focus {
      font-weight: bold;
      cursor: pointer;
      background-color: #E1E1E1;
      -webkit-animation: shadow-drop-bottom 1s cubic-bezier(.25, .46, .45, .94) both;
      animation: shadow-drop-bottom 1s cubic-bezier(.25, .46, .45, .94) both
    }

    @-webkit-keyframes shadow-drop-bottom {
      0% {
        -webkit-box-shadow: 0 0 0 0 transparent;
        box-shadow: 0 0 0 0 transparent
      }

      100% {
        -webkit-box-shadow: 0 12px 20px -12px rgba(0, 0, 0, .35);
        box-shadow: 0 12px 20px -12px rgba(0, 0, 0, .35)
      }
    }

    @keyframes shadow-drop-bottom {
      0% {
        -webkit-box-shadow: 0 0 0 0 transparent;
        box-shadow: 0 0 0 0 transparent
      }

      100% {
        -webkit-box-shadow: 0 12px 20px -12px rgba(0, 0, 0, .35);
        box-shadow: 0 12px 20px -12px rgba(0, 0, 0, .35)
      }
    }

    .fade-in-right {
      -webkit-animation: fade-in-right .6s cubic-bezier(.39, .575, .565, 1.000) both;
      animation: fade-in-right .6s cubic-bezier(.39, .575, .565, 1.000) both
    }

    .fade-out-bck {
      -webkit-animation: fade-out-bck .7s cubic-bezier(.25, .46, .45, .94) both;
      animation: fade-out-bck .7s cubic-bezier(.25, .46, .45, .94) both
    }

    @-webkit-keyframes fade-in-right {
      0% {
        -webkit-transform: translateX(50px);
        transform: translateX(50px);
        opacity: 0
      }

      100% {
        -webkit-transform: translateX(0);
        transform: translateX(0);
        opacity: 1
      }
    }

    @keyframes fade-in-right {
      0% {
        -webkit-transform: translateX(50px);
        transform: translateX(50px);
        opacity: 0
      }

      100% {
        -webkit-transform: translateX(0);
        transform: translateX(0);
        opacity: 1
      }
    }

    .fade-out-right {
      -webkit-animation: fade-out-right .7s cubic-bezier(.25, .46, .45, .94) both;
      animation: fade-out-right .7s cubic-bezier(.25, .46, .45, .94) both
    }

    @-webkit-keyframes fade-out-right {
      0% {
        -webkit-transform: translateX(0);
        transform: translateX(0);
        opacity: 1
      }

      100% {
        -webkit-transform: translateX(50px);
        transform: translateX(50px);
        opacity: 0
      }
    }

    @keyframes fade-out-right {
      0% {
        -webkit-transform: translateX(0);
        transform: translateX(0);
        opacity: 1
      }

      100% {
        -webkit-transform: translateX(50px);
        transform: translateX(50px);
        opacity: 0
      }
    }

</style>
