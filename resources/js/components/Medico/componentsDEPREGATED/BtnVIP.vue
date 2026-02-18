<template>
    <div class="px-1">
        <div class="btn-group" role="group">
            <!-- -->
            <a
                :content="getTolltipContent()"
                v-tippy="{ arrow : true, allowHTML:true, theme : 'tooltip-info'}"
                @click="handleItem()"

                class="px-1 m-0"
                type="button"

            >
                <span >
                    <i :class="['icon-size',icon, {'text-info':getActive()},{'text-info-disabled':!getActive()}]"></i>
                </span>
            </a>
            <!-- <div class="dropdown-menu" aria-labelledby="dropdownId">

            </div> -->

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
        name:"BtnVIP",
        data(){
            return {
                coments:"",
                model_name:"vip",
                title: "VIP",
                route_update:"user_vip",
                /* currentValue:0, */
                fieldName:"vip",
                episodio_prop_name:"vip_value",
                episodio_prop_name2:"vip_description",
                icon:"pc-paciente_vip",

            }
        },
        computed: {

           /*  currentTextColor(){

                this.currentValue = this.dataPaciente[this.model_name] === null ? 'info' : Number(this.dataPaciente[this.model_name])
                    return this.dropdownOptions.find(item=>item['id']===this.currentValue)['color']
            } */
        },
        methods:{
            getTolltipContent(){
                let item = this.dataPaciente[this.model_name+'_description']
                return  `
                            <span class='${this.icon} text-white'></span> <b>${this.title}:</b>
                            ${!is_null(item) ? '<br>'+item: ''}
                        `
            },
            getActive(){
                console.log(Number(this.dataPaciente[this.model_name]));
                return  [null,0].includes(Number(this.dataPaciente[this.model_name])) ? false : true
            },



            handleItem(){

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
                        this.updateItem()
                    }
                    if (result.isDenied) {
                        this.updateItem()
                    }
                })
            },
            async updateItem(){

                let that = this
                    this.$store.commit('updateProperty', {
                        fieldName:'loading',
                        fieldValue:true,
                    });
                let value = this.dataPaciente[this.model_name]

                let formData = new FormData();
                    formData.append("episodio_id", this.dataPaciente.episodio_id)
                    formData.append('value', value)
                    formData.append("user_id_paciente", this.dataPaciente.user_id)
                    formData.append("description", !is_empty( this.coments ) ? this.coments : null)
                    formData.append("created_at", timestamps() )
                    formData.append("_token", $("#_token").val())

                let model = await post(location.origin+"/"+this.route_update+"/store", formData)
                let temp = this.dataPaciente
                    temp[this.model_name] = model.value
                    temp[this.model_name+'_description'] = model.description

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
    .text-info-disabled {
        color: var(--info) !important;
        opacity: 0.2;
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
