<template>
    <div class="form-group">
        <label class="label-text text-secondary"  :for="tagValueText">{{ titleLabel }}:</label>
        <div class="d-flex justify-content-between">
            <!-- es select -- no es grupo -- no es grupo unico -->
            <div v-if="inputType==='select' && !isGroup && !groupUnique">
                <select
                    v-select2
                :data-tagValueText="tagValueText"
                :data-messageAlert="messageAlert"

                    @input="updateFormField"
                    v-model="$store.state.formReservacionQuirofano['input_'+tagValueText]"
                    :ref="'input_'+tagValueText"
                    class="form-control bg-gray-footer-parodi mr-1"
                    :name="'input_'+tagValueText"
                >
                    <option value="">Seleccione</option>
                    <option v-for="(item, index) in dataset" :key="index" :value="item">{{item}}</option>
                </select>
            </div>
            <!-- es select -- es grupo -- no es grupo unico -->
            <div v-if="inputType==='select' && isGroup && !groupUnique">
                <div v-if="!groupUnique">
                    <select
                        v-select2
                    :data-tagValueText="tagValueText"
                    :data-messageAlert="messageAlert"

                        @input="updateFormField"
                        v-model="$store.state.formReservacionQuirofano['input_'+tagValueText]"
                        :ref="'input_'+tagValueText"
                        class="form-control bg-gray-footer-parodi mr-1"
                        :name="'input_'+tagValueText"
                    >
                        <option value="">Seleccione</option>
                        <optgroup v-for="(item, index) in datasetGroup" :key="index" :label="item" >
                            <option v-for="(item2, index2) in filteredDataset(item)" :key="index2" :value="item2.user_id">
                                {{item2.description}}
                            </option>
                        </optgroup>
                    </select>
                </div>
            </div>
            <!-- es select -- es grupo unico -->
            <div v-if="inputType==='select' && groupUnique">
                <div v-if="groupUnique">
                    <select
                        v-select2
                        :data-tagValueText="tagValueText"
                        :data-messageAlert="messageAlert"

                        @input="updateFormField"
                        v-model="$store.state.formReservacionQuirofano['input_'+tagValueText]"
                        :ref="'input_'+tagValueText"
                        class="form-control bg-gray-footer-parodi mr-1"
                        :name="'input_'+tagValueText"
                    >
                        <!-- <option value="">Seleccione</option> -->
                        <option  v-for="(item2, index2) in dataset" :key="index2" :value="item2.user_id">
                            {{item2.description}}
                        </option>

                    </select>
                </div>
            </div>
            <!-- es input -- no es grupo -- no es grupo unico -->
            <input
                @keyup.enter="handleInput(tagValueText,messageAlert)"
                :data-tagValueText="tagValueText"
               :data-messageAlert="messageAlert"
                v-if="inputType=='text' && !isGroup && !groupUnique"
                :type="inputType"
                @input="updateFormField"
                v-model="$store.state.formReservacionQuirofano['input_'+tagValueText]"
                :ref="'input_'+tagValueText"
                class="form-control bg-gray-footer-parodi mr-1"
                :name="'input_'+tagValueText"
            >
            <!-- <button
                @click="handleInput(tagValueText,messageAlert)"
                type="button"
                class="btn btn-primary font-weight-bold"
            >
            +
            </button> -->
        </div>
        <input
            :id="'otros_'+tagValueText"
            :ref="'otros_'+tagValueText"
            type="text"
            :class="{'form-control mt-1':true,'d-none':!$store.state['otros_'+tagValueText]}"
            :placeholder="'Escribe otro '+titleLabel">
        <div v-if="Object.values(ObjectData).length > 0" >
            <ul class="list-group mt-1" id="cirujano_principalList">
                <!-- Aquí se agregarán los elementos de la lista -->
                <li v-for="(item, index) in ObjectData" :key="index" class="list-group-item d-flex justify-content-between align-items-center pl-1 py-1 pr-0">
                    <div>
                        {{item.description}}
                    </div>
                    <button @click="destroyItem(tagValueText,item.id)" class="btn btn-danger float-right font-weight-bold" >-</button>
                </li>

            </ul>
        </div>
        <div v-if="Object.values(ObjectData).length === 0" class="pl-1 py-1 pr-0">
            {{ messageAlert+titleLabel }}
        </div>
    </div>
</template>

<script>
import { is_undefined } from '../../../../helpers/customHelpers.js';


    export default {
        name:"Todolist",
        props:[
            'tagValueText',
            'titleLabel',
            'inputType',
            'dataset',
            'datasetGroup',
            'messageAlert',
            'isGroup',
            'groupUnique'
        ],
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
            equipoMedicoCirujanos(){

            }
        },
        methods: {
            filteredDataset(group) {
                // Filtra el conjunto de datos por grupo
                return this.dataset.filter(item => item.especialidad === group);
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
            handleInput(inputName,message){
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

            },
            destroyItem(objectName,index){

                let indiceAEliminar = index; // Índice del objeto que deseas eliminar
                //console.log(objectName)
                //console.log(indiceAEliminar)
                let temp_object = JSON.parse(this.$store.state.formReservacionQuirofano[ objectName ])
                //console.log(temp_object)
                    temp_object = temp_object.filter((item, key) => item.id !== indiceAEliminar)
                    //console.log(temp_object)
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
            },
        },
    }
</script>

<style lang="scss" scoped>
    .list-group-item-empty{
        position: relative;
        display: block;
        background-color: transparent;
        border: 2px dashed rgba(0, 0, 0, 0.125);
        text-align: center;
        color: var(--secondary);
        border-radius: 0.25rem;
    }
</style>
