<template>
    <div class="px-1">
        <div class="btn-group" role="group">
            <a
                @click="hasEvent ? clickEvent() :false"
                class="px-1 m-0"
                type="button"
                :data-toggle="hasMenu ? 'dropdown':false"
                aria-haspopup="true"
                aria-expanded="false"
            >
                <span 
                    data-tippy-content="
                        <b>
                            <i class='pc-cirugia'></i> 
                            Infección de herida: 
                        </b>
                        Estable <br> 
                        <small>Mensaje no indicado</small>
                    " 
                    style='font-size: 20px !important;' 
                    class="heartbeat p-0 m-0 font-weight-bold"
                >
                    <i :class="['icon-size',icon, currentTextColor]"></i>
                </span>
            </a>


            <div v-if="hasMenu" class="dropdown-menu" aria-labelledby="dropdownId">
                <div v-if="groupOptionsMenu1.includes(nameBtnGroup)">
                    <a data-value="1" class="dropdown-item cursor-pointer"><span :class="[{'text-success':true},icon]"></span>
                        Estable</a>
                    <a data-value="2" class="dropdown-item cursor-pointer"><span :class="[{'text-warning':true},icon]"></span>
                        Intermedio</a>
                    <a data-value="3" class="dropdown-item cursor-pointer"><span :class="[{'text-danger':true},icon]"></span>
                        De cuidado</a>
                </div>
                <div v-if="groupOptionsMenu2.includes(nameBtnGroup)">
                    <a class="dropdown-item cursor-pointer">
                        <span :class="['text-primary','pc-evo-medic']"></span>
                        Evolución Médica
                    </a>
                    <a class="dropdown-item cursor-pointer">
                        <span :class="['text-warning','pc-evo-nurse']"></span>
                        Evolución de Enfermería
                    </a>
                </div>
                <div v-if="groupOptionsMenu3.includes(nameBtnGroup)">
                    <a class="dropdown-item cursor-pointer">
                        <span :class="['text-success','pc-historia-inicial-solid']"></span>
                        Historia Inicial
                    </a>
                    <a class="dropdown-item cursor-pointer">
                        <span :class="['text-success','pc-historial-episodios-solid']"></span>
                        Episodios Anteriores
                    </a>
                    
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fullscreen-modal fade" id="modal-patient-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header p-0">
                            

                        </div>
                        <div class="modal-body fullscreen">
                           
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                    ...
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name:"BtnGroup",
        data(){
            return {
                groupOptionsMenu1:[
                    'Riesgo Cirugia',
                    'Riesgo Caida',
                    'Nivel de prioridad',
                ],
                groupOptionsMenu2:[
                   'Evolución Clínica'
                ],
                groupOptionsMenu3:[
                   'Historia Inicial'
                ],
            }
        },
        props:{
            nameBtnGroup:{
                type:String,
                default:"Sin Nombre"
            },
            clickEvent:{
                type:Function,
                default:()=>false
            },
            currentValue:{
                type:Number,
                default:3
            },
            hasEvent:{
                 type:Boolean,
                default:false
            },
            hasPersonalColor:{
                 type:Boolean,
                default:false
            },
            icon:String,
            personalColor:{
                type:String,
                default:"success"
            },
            hasMenu:{
                type:Boolean,
                default:true
            },
        },
        computed: {
            currentTextColor(){
                if(this.hasPersonalColor){
                    return 'text-'+this.personalColor
                }
                
                if(this.currentValue===3){
                    return 'text-success'
                }
                if(this.currentValue===2){
                    return 'text-warning'
                }
                if(this.currentValue===1){
                    return 'text-danger'
                }
            }
        },
    }
</script>

<style lang="scss" scoped>
    .icon-size{
        font-size: 1.5rem;
    }
</style>