<template>
    <div class="px-1">
        <div class="btn-group" role="group">
            <a
                :content="getTolltipContent()"
                v-tippy="{ arrow : true, allowHTML:true, theme : 'tooltip-'+currentTextColor }"
                class="px-1 m-0"
                type="button"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
            >
                <span :ref="fieldName+'_'+dataPaciente.episodio">
                    <i :class="['icon-size',getItemIcon(), 'text-'+currentTextColor,{'ping-2':Number(dataPaciente[model_name])===1},{'ping':Number(dataPaciente[model_name])===2}]"></i>
                </span>
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownId">
                <a v-for="(item, index) in dropdownOptions" :key="index"
                    @click="handleItem(item.id)"
                    :data-value="item.id"
                    :class="['dropdown-item cursor-pointer',{'active':getActive(item.id)}]"
                >
                    <span :class="[item.icon, 'text-'+item.color]"></span>
                    {{ item.description }}
                </a>
            </div>

        </div>
    </div>
</template>

<script>
    import { get, post, is_empty, is_null, is_undefined, timestamps } from '../../../helpers/customHelpers';

    export default {
        props:{
            index_row:Number,
            dataPaciente:Object
        },
        name:"BtnGroupRiesgoAlerta",
        data(){
            return {
                coments:"",
                model_name:"alert",

                title: "Alerta",
                route_update:"user_cuest_alert",
                currentValue:3,
                fieldName:"alert",
                episodio_prop_name:"alert_riesgo_value",
                episodio_prop_name2:"alert_riesgo_description",
                icon:"pc-cirugia",
                dropdownOptions:[
                    {id:3,description:"Estable", color:"success", icon:"pc-alerta_estable"},
                    {id:2,description:"Intermedio", color:"warning", icon:"pc-alerta_intermedia"},
                    {id:1,description:"De cuidado", color:"danger", icon:"pc-alerta_alta"},
                ]

            }
        },
        computed: {

            currentTextColor(){

                this.currentValue = this.dataPaciente[this.model_name] === null ? 3 : Number(this.dataPaciente[this.model_name])
                    return this.dropdownOptions.find(item=>item['id']===this.currentValue)['color']
            }
        },
        methods:{
            getTolltipContent(){
                let item = this.dataPaciente[this.model_name+'_description']
                return  `
                            <span class='${this.getItemIcon()} text-white'></span> <b>${this.title}:</b> ${this.getItemDescription()}
                            ${!is_null(item) ? '<br>'+item: ''}
                        `
            },
            getActive(valueOption){
                   return ( this.dataPaciente[this.model_name]  === null  ? 3 : Number(this.dataPaciente[this.model_name] ) ) === valueOption
            },
            getItemDescription(){
                return this.dropdownOptions.find(x=>x['id'] === this.currentValue)['description']
            },
            getItemIcon(){
                return this.dropdownOptions.find(x=>x['id'] === this.currentValue)['icon']
            },


            handleItem(value){

                Swal.fire({
                    icon:"warning",
                    title: this.title,
                    html:`
                        <label>Escribe un comentario sobre tu selección. (Opcional):</label>
                        <textarea class="form-control" id="input"></textarea>
                    `,
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: 'Guardar',
                    denyButtonText: `Cancelar`,

                }).then( async (result) => {
                    this.coments = document.getElementById('input').value

                    if (result.isConfirmed) {
                        this.updateItem(value)
                    }
                })
            },
            async updateItem(value){
                let that = this
                    this.$store.commit('updateProperty', {
                        fieldName:'loading',
                        fieldValue:true,
                    });


                let formData = new FormData();
                    formData.append("episodio_id", this.dataPaciente.episodio_id)
                    formData.append('alert', value)
                    formData.append("user_id_paciente", this.dataPaciente.user_id)
                    formData.append("description", !is_empty( this.coments ) ? this.coments : null)
                    formData.append("created_at", timestamps() )
                    formData.append("_token", $("#_token").val())

                let model = await post(location.origin+"/"+this.route_update+"/store", formData)

                let temp = this.dataPaciente
                    temp[this.model_name] = value
                    temp[this.model_name+'_description'] = this.coments
                    this.$store.commit('updateEpisodio', {
                        formName:'pacientes_datos',
                        index:this.index_row,
                        fieldValue: temp
                    });

                    this.$store.commit('updateProperty', {
                        fieldName:'loading',
                        fieldValue:false,
                    });
            },

        },
        mounted() {

        },
    }
</script>

<style lang="scss" scoped>
    .icon-size{
        font-size: 1.5rem;
    }
    .ping-2 {
        -webkit-animation: ping .5s ease-in-out infinite both;
        animation: ping .5s ease-in-out infinite both
    }
    @-webkit-keyframes ping {
        0% {
            -webkit-transform: scale(.2);
            transform: scale(.2);
            opacity: .8
        }
        80% {
            -webkit-transform: scale(1.2);
            transform: scale(1.2);
            opacity: 0
        }
        100% {
            -webkit-transform: scale(2.2);
            transform: scale(2.2);
            opacity: 0
        }
    }
    @keyframes ping {
        0% {
            -webkit-transform: scale(.2);
            transform: scale(.2);
            opacity: .8
        }
        80% {
            -webkit-transform: scale(1.2);
            transform: scale(1.2);
            opacity: 0
        }
        100% {
            -webkit-transform: scale(2.2);
            transform: scale(2.2);
            opacity: 0
        }
    }
    .ping {
        -webkit-animation: ping 2s ease-in-out infinite both;
        animation: ping 2s ease-in-out infinite both
    }
    @-webkit-keyframes ping {
        0% {
            -webkit-transform: scale(.2);
            transform: scale(.2);
            opacity: .8
        }
        80% {
            -webkit-transform: scale(1.2);
            transform: scale(1.2);
            opacity: 0
        }
        100% {
            -webkit-transform: scale(2.2);
            transform: scale(2.2);
            opacity: 0
        }
    }
    @keyframes ping {
        0% {
            -webkit-transform: scale(.2);
            transform: scale(.2);
            opacity: .8
        }
        80% {
            -webkit-transform: scale(1.2);
            transform: scale(1.2);
            opacity: 0
        }
        100% {
            -webkit-transform: scale(2.2);
            transform: scale(2.2);
            opacity: 0
        }
    }


</style>
