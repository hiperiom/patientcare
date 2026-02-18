<template>
    <div class="dropdown m-0">
        <button class="btn font-weight-bold border-0 dropdown-toggle d-flex align-items-center" :style="{'color':textColor}" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
            <div v-html="btnText"></div>
        </button>
        <div @click="dropdownStop" class="dropdown-menu p-3" aria-labelledby="triggerId">
            <h6 :class="{'dropdown-header ':true}">{{dropdownHeader[0]}}</h6>
            <div class="d-flex justify-content-between">
                <select style="width: 15vw;"
                    :ref="tipo_personal1"
                    class="form-control bg-gray-footer-parodi mr-1"
                    v-model="formData[tipo_personal1]"
                >
                    <option value="">Seleccione</option>
                    <option
                        v-for="(personal, index_personal) in selectOptions1"
                        :key="index_personal"
                        :value="personal.user_id"

                    >
                        {{personal.medico}}
                    </option>
                </select>
                <button
                    @click="handleAddPersonal(tipo_personal1)"
                    class="btn btn-primary"
                >+</button>
            </div>
            <h6 :class="{'dropdown-header':true,color_personal2:true}">{{dropdownHeader[1]}}</h6>
            <div class="d-flex justify-content-between">
                <select style="width: 15vw;"
                    :ref="tipo_personal2"
                    class="form-control bg-gray-footer-parodi mr-1"
                    v-model="formData[tipo_personal2]"
                >
                    <option value="">Seleccione</option>
                    <option
                        v-for="(personal, index_personal) in selectOptions2"
                        :key="index_personal"
                        :value="personal.user_id"

                    >
                        {{personal.medico}}
                    </option>
                </select>
                <button
                    @click="handleAddPersonal(tipo_personal2)"
                    class="btn btn-primary"
                >+</button>
            </div>
            <h6 :class="{'dropdown-header':true,color_personal3:true}">{{dropdownHeader[2]}}</h6>
            <div class="d-flex justify-content-between">
                <select style="width: 15vw;"
                    :ref="tipo_personal3"
                    class="form-control bg-gray-footer-parodi mr-1"
                    v-model="formData[tipo_personal3]"
                >
                    <option value="">Seleccione</option>
                    <option
                        v-for="(personal, index_personal) in selectOptions3"
                        :key="index_personal"
                        :value="personal.user_id"
                    >
                        {{personal.medico}}
                    </option>
                </select>
                <button
                    @click="handleAddPersonal(tipo_personal3)"
                    class="btn btn-primary"
                >+</button>
            </div>
        </div>
    </div>




</template>

<script>
    import { is_empty, is_undefined, post } from '../../../../../helpers/customHelpers';


    export default {
        props:[
            'dropdownHeader',
            'btnText',
            'textColor',
            'selectOptions1',
            'selectOptions2',
            'selectOptions3',
            'tipo_personal1',
            'tipo_personal2',
            'tipo_personal3',
            'color_personal1',
            'color_personal2',
            'color_personal3',
            'estadoPropiedad',
            'cat_quirofano_id',
            'quirofano_index',
        ],
        name:"TodolistDropdown",
        data(){
            return {
                formData:{
                    /* selectOptions1:"",
                    selectOptions2:"",
                    selectOptions3:"", */
                },
            }
        },
        directives: {

            select2: {

                inserted(el, binding, vnode) {

                    // Inicializar el select2 en el elemento
                    $(el).select2({
                        placeholder: 'Selecciona una opción',
                    //allowClear: true
                    });


                    // Escuchar el evento de presionar Enter
                    $(el).on('change', function(event) {
                        let {messagealert,tagvaluetext} =event.currentTarget.dataset
                        vnode.context.handleInput(tagvaluetext,messagealert)
                        //$(el).val("")
                        //$(el).focus()

                    })
                    $(el).on('keydown', function(event) {
                        if (event.keyCode === 13) {
                            event.preventDefault(); // Evitar el comportamiento predeterminado del "Enter" en el select
                            binding.value(); // Llama a la función proporcionada en la directiva
                            //console.log(binding.value())
                        }
                    });
                }
            }
        },
        computed:{
            ObjectData(){
                return JSON.parse(this.$store.state.formReservacionQuirofano[ this.tagValueText ])
            },
            /* equipoMedicoCirujanos(){

            } */
        },
        methods: {
            async handleAddPersonal(property){
                if(is_empty(this.formData[ property ])){
                    alert("Seleccione una opción del listado.")
                    this.$refs[property].focus()
                    return false
                }

            let user_id = this.formData[ property ]

                //verificamos si el usuario ya fue agregado
                if(this.estadoPropiedad === "personalAsistencial"){
                    if(this.$store.state.personalAsistencial[this.quirofano_index]['personal_asistencial'].length > 0){
                        let existeUser = this.$store.state.personalAsistencial[this.quirofano_index]['personal_asistencial'].some(x=>x['user_id'] === user_id && x['tipo_personal'] === property && x['active'] === 1)
                            if(existeUser){
                                alert("Esta persona ya se encuentra agregada.")
                                return false
                            }
                    }
                }
                if(this.estadoPropiedad === "otroPersonalAsistencial"){
                    if(this.$store.state.otroPersonalAsistencial.length > 0){
                        let existeUser = this.$store.state.otroPersonalAsistencial.some(x=>x['user_id'] === user_id  && x['tipo_personal'] === property && x['active'] === 1)
                            if(existeUser){
                                alert("Esta persona ya se encuentra agregada.")
                                return false
                            }
                    }
                }
                try {
                    let formData = new FormData();
                        formData.append("cat_quirofano_id",this.cat_quirofano_id)
                        formData.append("user_id",user_id)
                        formData.append("tipo_personal",property )
                        formData.append("_token", document.querySelector('meta[name="csrf-token"]').getAttribute('content') )

                    let result = await post(location.origin + `/areaQuirofanoAmb/personal_asistencial/create`,formData)
                        if(this.estadoPropiedad === "personalAsistencial"){
                            this.$store.commit('updatePersonalAsistencialEnfermeria', {
                                index: this.quirofano_index,
                                value:result
                            });
                        }
                        if(this.estadoPropiedad === "otroPersonalAsistencial"){
                            this.$store.commit('updateOtroPersonalAsistencialEnfermeria', result);
                        }

                        this.formData[ property ]=""

                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Personal asignado exitosamente.',
                            showConfirmButton: false,
                            timer: 1500
                        })

                } catch (error) {
                    console.log(error)
                }

//state[ 'personalAsistencial' ][form.index]['personal_asistencial'][form.index2][form.field]

              //  let {tipo_personal} = this.$refs[property].dataset
/*
                //console.log(this.formData)

               // let row = this.$store.state.personalAsistencial[index]
                console.log(this.cat_quirofano_id,user_id,property)

                //console.log(result)
                 */

            },

            /* async handleEnfermeria(index,field){
                let row = this.$store.state.personalAsistencial[index]
                //console.log(this.$store.state.personalAsistencial[index])
                let formData = new FormData();
                        formData.append("id",row.id)
                        formData.append("field",field)
                        formData.append("value",this.$store.state.personalAsistencial[ index ][field] )
                        formData.append("_token", document.querySelector('meta[name="csrf-token"]').getAttribute('content') )

                    let result2 = await post(location.origin + `/areaQuirofanoAmb/personal_asistencial/update`,formData)
                    //console.log(result2)
            }, */
            dropdownStop(e){
                 e.stopPropagation();
               // console.log(`${e.target.textContent} clicado!`);
            },
            childRef() {
                return this.$refs[ 'input_'+this.tagValueText ] ;
            },
            updateFormField(event) {
                this.$store.commit('updateFormField', {
                    formName:"formReservacionQuirofano",
                    fieldName:event.currentTarget.name,
                    fieldValue:event.currentTarget.value,
                });
            },
            /* handleInput(inputName,message){
                let inputValue = this.$refs[ 'input_'+inputName ].value
                    //console.log(inputName+"---"+inputValue)

                    if(
                        inputName==="equipos_especiales" &&
                        inputValue === "Otros"
                    ){
                        let otroInput = document.querySelector('#otros_'+inputName).value
                        if( otroInput === ""){
                            alert(message)
                            this.$refs[ 'otros_'+inputName ].focus();
                            return false
                        }else{
                            inputValue = this.$refs[ 'otros_'+inputName ].value
                            this.$refs[ 'otros_'+inputName ].value =""
                        }

                    }

                    if( inputValue === ""){
                        alert(message)
                        this.$refs[ 'input_'+inputName ].focus();
                        return false
                    }
                let taskCounter = this.$store.state.formReservacionQuirofano[inputName+'Counter'] + 1

                let temp_object = JSON.parse(this.$store.state.formReservacionQuirofano[ inputName ])


                let existeRegistro = JSON.parse(this.$store.state.formReservacionQuirofano[inputName]).find(x=>Number(x.id)===Number(inputValue))
                        if(!is_undefined(existeRegistro)){
                            return false // no continuar si el registro existe
                        }

                    if([
                        'input_anestesiologo',
                        'input_cirujano_principal',
                        'input_ayudante_1',
                        'input_ayudante_2',
                        'input_ayudante_3',
                        'input_instrumentista',
                        'input_circulante_cirugia',
                        'input_circulante_anestesia'
                        ].includes('input_'+inputName)
                    ){
                        //console.log(this)

                        let selectedOption = this.$refs[ 'input_'+inputName ].options[this.$refs[ 'input_'+inputName ].selectedIndex];
                        let selectedText = selectedOption.text;
                        //console.log(selectedText)

                        temp_object.push({
                            "id": inputValue,
                            "description": selectedText,
                        })
                    }else{
                        temp_object.push({
                            "id": taskCounter,
                            "description": inputValue,
                        })
                    }

                    temp_object = JSON.stringify(temp_object)
                    //console.log(temp_object)
                    //actualizar listado
                    this.$store.commit('updateFormField', {
                        formName:"formReservacionQuirofano",
                        fieldName:inputName,
                        fieldValue:temp_object
                    });
                    //incrementar el contador
                    this.$store.commit('updateFormField', {
                        formName:"formReservacionQuirofano",
                        fieldName:inputName+'Counter',
                        fieldValue:taskCounter,
                    });

                    //limpiar el campo
                    this.$store.commit('updateFormField', {
                        formName:"formReservacionQuirofano",
                        fieldName: "input_"+inputName,
                        fieldValue:"",
                    });

            }, */
            /* destroyItem(objectName,index){

                let indiceAEliminar = index; // Índice del objeto que deseas eliminar
                //console.log(objectName)
                //console.log(indiceAEliminar)
                let temp_object = JSON.parse(this.$store.state.formReservacionQuirofano[ objectName ])
                //console.log(temp_object)
                    temp_object = temp_object.filter((item, key) => item.id !== indiceAEliminar)
                    console.log(temp_object)
                    temp_object = JSON.stringify(temp_object)
                    this.$store.commit('updateFormField', {
                        formName:"formReservacionQuirofano",
                        fieldName:objectName,
                        fieldValue:temp_object
                    });
                let taskCounter = this.$store.state.formReservacionQuirofano[objectName+"Counter"] - 1
                    this.$store.commit('updateFormField', {
                        formName:"formReservacionQuirofano",
                        fieldName:objectName+"Counter",
                        fieldValue:taskCounter,
                    });
            }, */
        },
        mounted(){
            this.formData[this.tipo_personal1] = ""
            this.formData[this.tipo_personal2] = ""
            this.formData[this.tipo_personal3] = ""
        }
    }
</script>

<style lang="scss" scoped>
.btn-link:hover{
        background-color: rgb(236, 236, 236);
    }
    .list-group-item-empty{
        position: relative;
        display: block;
        background-color: transparent;
        /*border: 2px dashed rgba(0, 0, 0, 0.125);*/
        text-align: center;
        color: var(--secondary);
        border-radius: 0.25rem;
    }
</style>
