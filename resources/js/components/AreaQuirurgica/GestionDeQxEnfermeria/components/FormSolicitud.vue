<template>
    <div class="flex-grow-1 d-flex flex-column overflow-auto" id="content">
        <div class="flex-fill  container-fluid d-flex flex-column overflow-auto">
          <div class="d-flex py-2 flex-column flex-sm-row align-items-center  align-items-sm-center justify-content-center justify-content-sm-between">
              <div class="title-option-page text-primary mb-0">{{$route.name}}</div>
              <div class="d-flex">
                <router-link target="_blank" class="btn btn-success mt-1 mr-1 mt-sm-0"
                to="/areaQuirofano/cupo/index">Plan Quirúrgico</router-link>
                <router-link class="btn btn-primary-custom mt-1 mt-sm-0"
                to="/areaQuirofano/index_quirofano">Regresar</router-link>
              </div>
            </div>
            <div class="flex-fill d-flex flex-column overflow-auto">
                <div class="overflow-auto mb-4 pb-4">
                        <div class="form container mb-4 pb-4">
                        <div class="row">
    
                            <div class="col-12 h5 text-primary font-weight-bold">
                                Servicio médico soliciante
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label class="label-text text-secondary" for="tipo_cupo">Tipo de cupo:</label>
                                    <select  ref="tipo_cupo" @input="updateFormField" v-model="$store.state.formReservacionQuirofano.tipo_cupo" type="text" class="form-control bg-gray-footer-parodi mr-1" name="tipo_cupo" id="tipo_cupo">
                                        <option value="Quirúrgico">Quirúrgico</option>
                                        <option value="Procedimiento">Procedimiento</option>
                                        <option value="Estudio">Estudio</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label class="label-text text-secondary" for="tipo_cupo">Motivo de asignación de quirófano:</label>
                                    <select  ref="tipo_reservacion" @input="updateFormField" v-model="$store.state.formReservacionQuirofano.tipo_reservacion" class="form-control bg-gray-footer-parodi mr-1" name="tipo_reservacion" id="tipo_reservacion">
                                        <option value="Emergencia">Emergencia</option>
                                        <option value="Electiva">Electiva</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 h5 text-primary font-weight-bold">
                                Datos del paciente
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label class="label-text text-secondary" for="cedula">Documento de identidad</label>
                                    <div class="d-flex align-items-center">
                                        <select  @input="updateFormField" v-model="$store.state.formReservacionQuirofano.nacionalidad" id="nacionalidad" class="flex-shrink-1 form-control bg-gray-footer-parodi" name="nacionalidad"  style="width: fit-content;">
                                            <option value="V">V</option>
                                            <option value="E">E</option>
                                            <option value="P">P</option>
                                        </select>
    
                                        <div class="input-group">
    
                                            <input id="cedula" ref="cedula" @change="searchCedula" @input="updateFormField" v-model="$store.state.formReservacionQuirofano.cedula" type="number" class="ml-1 flex-grow-1 form-control bg-gray-footer-parodi" name="cedula" aria-describedby="helpcedula">
                                            <div class="input-group-prepend">
                                                <div :class="{'input-group-text p-0 ml-2 border-0 bg-transparent':true,'d-none':!searchingCedula}">
                                                  <div class="spinner-border text-primary" role="status">
                                                      <span class="sr-only">Loading...</span>
                                                  </div>
                                                </div>
                                              </div>
                                          </div>
                                    </div>
                                    <small id="sms_cedula" class="form-text text-danger notification"></small>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label class="label-text text-secondary" for="email">Correo electrónico</label>
                                    <input id="email"  ref="email" @input="updateFormField" v-model="$store.state.formReservacionQuirofano.email" type="email" class="form-control bg-gray-footer-parodi" name="email"  aria-describedby="helpId" placeholder="">
                                    <small id="sms_email" class="form-text text-danger notification"></small>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label class="label-text text-secondary" for="nombre">Nombres</label>
                                    <input id="nombres" ref="nombres" @input="updateFormField" v-model="$store.state.formReservacionQuirofano.nombres" type="text" class="form-control bg-gray-footer-parodi" name="nombres"  aria-describedby="helpId" placeholder="">
                                    <small id="helpId1" class="form-text text-muted notification"></small>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label class="label-text text-secondary" for="apellido">Apellidos</label>
                                    <input id="apellidos" ref="apellidos" @input="updateFormField" v-model="$store.state.formReservacionQuirofano.apellidos" type="text" class="form-control bg-gray-footer-parodi" name="apellidos"  aria-describedby="helpId" placeholder="">
                                    <small id="helpId1" class="form-text text-muted notification"></small>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label class="label-text text-secondary" for="genero">Género</label>
                                    <select id="genero" ref="genero" @input="updateFormField" v-model="$store.state.formReservacionQuirofano.genero" class="form-control bg-gray-footer-parodi" name="genero"  aria-describedby="helpId" placeholder="">
                                        <option value="m">Masculino</option>
                                        <option value="f">Femenino</option>
                                    </select>
                                    <small id="helpId1" class="form-text text-muted notification"></small>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label class="label-text text-secondary" for="fnacimiento">Fecha de nacimiento</label>
                                    <div class="input-group mb-3">
                                        <input type="date" ref="fnacimiento" @input="updateFormField" v-model="$store.state.formReservacionQuirofano.fnacimiento" class="form-control bg-gray-footer-parodi" name="fnacimiento" id="fnacimiento" aria-describedby="helpId" placeholder="">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2"><i class="fas fa-birthday-cake mr-2"></i>  {{ calcularEdad }} años</span>
                                        </div>
                                    </div>
    
    
                                    <small id="helpId1" class="form-text text-muted notification"></small>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label class="label-text text-secondary" for="telefono_movil">Teléfono contacto</label>
                                    <input type="number" ref="telefono_movil" @input="updateFormField" v-model="$store.state.formReservacionQuirofano.telefono_movil" class="form-control bg-gray-footer-parodi" name="telefono_movil" id="telefono_movil" aria-describedby="helpId" placeholder="">
                                    <small id="help_telefono_movil" class="form-text text-muted notification"></small>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label class="label-text text-secondary" for="telefono_hogar">Teléfono secundario</label>
                                    <input type="number"  ref="telefono_hogar" @input="updateFormField" v-model="$store.state.formReservacionQuirofano.telefono_hogar" class="form-control bg-gray-footer-parodi" name="telefono_hogar" id="telefono_hogar" aria-describedby="helpId" placeholder="">
                                    <small id="help_telefono_hogar" class="form-text text-muted notification"></small>
                                </div>
                            </div>
                            <div class="col-12 my-3 h5 text-primary font-weight-bold">
                                Datos de la intervención, procedimiento o estudio
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label class="label-text text-secondary"  for="n_presupuesto">Presupuesto nro:</label>
                                    <input ref="n_presupuesto" @input="updateFormField" v-model="$store.state.formReservacionQuirofano.n_presupuesto" type="number" class="form-control bg-gray-footer-parodi" name="n_presupuesto" id="n_presupuesto">
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label class="label-text text-secondary"  for="fecha_reservacion">Día de la círugía o estudio:</label>
                                    <input ref="fecha_reservacion" @input="updateFormField" v-model="$store.state.formReservacionQuirofano.fecha_reservacion" type="date" class="form-control bg-gray-footer-parodi" name="fecha_reservacion" id="fecha_reservacion">
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label class="label-text text-secondary"  for="h_inicio">Hora de inicio:</label>
                                    <input ref="h_inicio" @input="updateFormField" v-model="$store.state.formReservacionQuirofano.h_inicio" type="time" class="form-control bg-gray-footer-parodi" name="h_inicio" id="h_inicio">
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label class="label-text text-secondary" for="h_fin">Horas (estimadas) de duración:</label>
    
                                    <select
                                    ref="h_fin"
                                        @input="updateFormField"
                                        v-model="$store.state.formReservacionQuirofano.h_fin"
                                        class="form-control bg-gray-footer-parodi"
                                        name="h_fin"
                                        id="h_fin"
                                    >
                                        <option value="0.25">15 min</option>
                                        <option value="0.50">30 min</option>
                                        <option value="0.75">45 min</option>
                                        <option v-for="numero in numeros" :key="numero" :value="numero">{{ numero }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label class="label-text text-secondary"  for="dias_hospitalizacion">Días de Hospitalización:</label>
                                    <div class="d-flex align-items-center">
                                        <input ref="dias_hospitalizacion" @input="updateFormField" v-model="$store.state.formReservacionQuirofano.dias_hospitalizacion" type="number" class="form-control bg-gray-footer-parodi" name="dias_hospitalizacion" id="dias_hospitalizacion">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label class="label-text text-secondary"  for="dias_hospitalizacion">Días en UTI:</label>
                                    <input ref="dias_uti" @input="updateFormField" v-model="$store.state.formReservacionQuirofano.dias_uti" type="number" class="form-control bg-gray-footer-parodi" name="dias_uti" id="dias_uti">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="label-text text-secondary"  for="diagnostico_preoperatorio">Diagnóstico pre-operatorio:</label>
                                    <input ref="diagnostico_preoperatorio" @input="updateFormField" v-model="$store.state.formReservacionQuirofano.diagnostico_preoperatorio" type="text" class="form-control bg-gray-footer-parodi" name="diagnostico_preoperatorio" id="diagnostico_preoperatorio">
                                </div>
                            </div>
                            <!-- <div class="col-12">
                                <Todolist
                                    ref="intervencion"
                                    tagValueText="intervencion"
                                    titleLabel="Intervención, procedimiento o estudio a realizar"
                                    inputType="text"
                                    messageAlert="Escribe y confirma (con tecla Enter), al menos una "
                                    :isGroup="false"
                                    :groupUnique="false"
                                />
    
                            </div> -->
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label class="label-text text-secondary" for="n_quirofano">Quirófano:</label>
                                    <select ref="n_quirofano" @input="updateFormField" v-model="$store.state.formReservacionQuirofano.n_quirofano" class="form-control bg-gray-footer-parodi mr-1" name="n_quirofano"  id="n_quirofano">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label class="label-text text-secondary" for="anestesia_sugerida">Anestesia sugerida:</label>
                                    <select  ref="anestesia_sugerida" @input="updateFormField" v-model="$store.state.formReservacionQuirofano.anestesia_sugerida" class="form-control bg-gray-footer-parodi mr-1" name="anestesia_sugerida" id="anestesia_sugerida">
                                        <option value="General">General</option>
                                        <option value="Local">Local</option>
                                        <option value="Epidural">Epidural</option>
                                        <option value="Troncular">Troncular</option>
                                        <option value="Otro">Otro</option>
                                    </select>
                                </div>
                            </div>
    
    
    
                            <div class="container p-1 mb-3">
                                <div id="contenedor_intervencion">
                                  <div  :ref="'item_'+index" v-for="(item,index) in $store.state.formReservacionQuirofano.intervencion" :key="index" class="container p-0 align-items-center d-flex">
                                    <!-- <b :class="[{'d-none':$store.state.formReservacionQuirofano.intervencion.length < 2}, 'mr-2 align-self-start h1 text-primary']">{{index+1}}</b> -->
                                    <div  v-if="!item['deleted']" class="container">
                                      <div class="row bg-light shadow-sm mt-2 rounded-custom-1">
                                        <div class="col-12 d-flex flex-column p-1 mr-1 mt-1">
                                          <label class="label-text text-secondary" for="destino">Intervención, procedimiento o estudio a realizar:</label>
                                          <div class="flex-fill">
                                              <input
                                              :ref="'description_'+index"
                                              :value="item['description']"
                                              @change="updateIntervencionDescription(index,'description')"
                                              type="text" class="form-control bg-gray-footer-parodi mr-1">
                                          </div>
                                        </div>
                                        <div class="container-fluid">
                                          <div class="row overflow-auto">
                                            <div class="col-12 col-sm-4 col-md-3 col-lg-4 d-flex flex-column p-0 pb-1 px-1">
                                                <label class="label-text text-secondary d-flex" for="">
                                                    Cirujano Prin<span class="d-sm-block d-none d-lg-none">.</span><span class="d-sm-none d-lg-block">cipal</span>
                                                </label>
                                                <div class="d-flex flex-column">
                                                    <select
                                                        :data-index="index"
                                                        data-ref="cirujano_principal"
                                                        :ref="'cirujano_principal_'+index"
    
                                                        :class="['form-control bg-gray-footer-parodi']"
                                                    >
                                                        <option value="">Seleccione</option>
    
                                                        <optgroup class="text-primary"  v-for="(grupoEspecialidad, indexEsp) in $store.state.especialidadesUnicas" :key="indexEsp" :label="grupoEspecialidad">
                                                            <option class="text-secondary" v-for="(item3, index3) in getGrupoEquipoSalud(grupoEspecialidad)" :key="index3" :value="item3['id']">{{item3['description']}}</option>
                                                        </optgroup>
                                                    </select>
                                                    <div class="rounded-custom-1 mb-auto mt-1" style="background-color: #efefef !important;">
    
                                                        <div v-for="(item2,index2) in (item.hasOwnProperty('cirujano_principal') ? item['cirujano_principal'] :[] )" :key="index2" class="d-flex align-items-center mt-1">
                                                            <span class="text-secondary mx-1">{{index2+1}}</span>
                                                            <div :class="['flex-fill']">
                                                                {{ item2.description }}
                                                            </div>
                                                            <button @click="destroyIntervencionItem(index,'cirujano_principal',index2)" class="ml-1 text-primary btn border-0"><i class="fa fa-times"></i></button>
                                                        </div>
    
    
                                                        <div
                                                            v-if="item['cirujano_principal'].length ===0"
                                                            class="text-center text-secondary rounded p-2 d-flex justify-content-center align-items-center"
                                                        >
                                                            Seleccione Cirujano Prin<span class="d-sm-block d-none">.</span><span class="d-sm-none">cipal</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4 col-md-3 col-lg-4 d-flex flex-column p-0 pb-1 pr-1">
                                                <label class="label-text text-secondary d-flex" for="">
                                                    Ayudante 1
                                                </label>
                                                <div class="d-flex flex-column">
                                                    <select
                                                        :data-index="index"
                                                        data-ref="ayudante_1"
                                                        :ref="'ayudante_1_'+index"
    
                                                        :class="['form-control bg-gray-footer-parodi']"
                                                    >
                                                        <option value="">Seleccione</option>
    
                                                        <optgroup class="text-primary"  v-for="(grupoEspecialidad, indexEsp) in $store.state.especialidadesUnicas" :key="indexEsp" :label="grupoEspecialidad">
                                                            <option class="text-secondary" v-for="(item3, index3) in getGrupoEquipoSalud(grupoEspecialidad)" :key="index3" :value="item3['id']">{{item3['description']}}</option>
                                                        </optgroup>
                                                    </select>
                                                    <div class="rounded-custom-1 mb-auto mt-1" style="background-color: #efefef !important;">
                                                        <div v-for="(item2,index2) in item['ayudante_1']" :key="index2" class="d-flex align-items-center mt-1">
                                                            <span class="text-secondary mx-1">{{index2+1}}</span>
                                                            <div :class="['flex-fill']">
                                                                {{ item2.description }}
                                                            </div>
                                                            <button @click="destroyIntervencionItem(index,'ayudante_1',index2)" class="ml-1 text-primary btn border-0"><i class="fa fa-times"></i></button>
                                                        </div>
                                                         <div v-if="item['ayudante_1'].length ===0" class="text-center text-secondary rounded p-2 d-flex justify-content-center align-items-center">
                                                            Seleccione Ayudante 1
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4 col-md-3 col-lg-4 d-flex flex-column p-0 pb-1 pr-1">
                                                <label class="label-text text-secondary d-flex" for="">
                                                    Ayudante 2
                                                </label>
                                                <div class="d-flex flex-column">
                                                    <select
                                                        :data-index="index"
                                                        data-ref="ayudante_2"
                                                        :ref="'ayudante_2_'+index"
    
                                                        :class="['form-control bg-gray-footer-parodi']"
                                                    >
                                                        <option value="">Seleccione</option>
    
                                                        <optgroup class="text-primary"  v-for="(grupoEspecialidad, indexEsp) in $store.state.especialidadesUnicas" :key="indexEsp" :label="grupoEspecialidad">
                                                            <option class="text-secondary" v-for="(item3, index3) in getGrupoEquipoSalud(grupoEspecialidad)" :key="index3" :value="item3['id']">{{item3['description']}}</option>
                                                        </optgroup>
                                                    </select>
                                                    <div class="rounded-custom-1 mb-auto mt-1" style="background-color: #efefef !important;">
                                                        <div v-for="(item2,index2) in item['ayudante_2']" :key="index2" class="d-flex align-items-center mt-1">
                                                            <span class="text-secondary mx-1">{{index2+1}}</span>
                                                            <div :class="['flex-fill']">
                                                                {{ item2.description }}
                                                            </div>
                                                            <button @click="destroyIntervencionItem(index,'ayudante_2',index2)" class="ml-1 text-primary btn border-0"><i class="fa fa-times"></i></button>
                                                        </div>
                                                        <div v-if="item['ayudante_2'].length ===0" class="text-center text-secondary rounded p-2 d-flex justify-content-center align-items-center">
                                                            Seleccione Ayudante 2
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4 col-md-3 col-lg-4 d-flex flex-column p-0 pb-1 pr-1">
                                                <label class="label-text text-secondary d-flex" for="">
                                                    Ayudante 3
                                                </label>
                                                <div class="d-flex flex-column">
                                                    <select
                                                        :data-index="index"
                                                        data-ref="ayudante_3"
                                                        :ref="'ayudante_3_'+index"
    
                                                        :class="['form-control bg-gray-footer-parodi']"
                                                    >
                                                        <option value="">Seleccione</option>
    
                                                        <optgroup class="text-primary"  v-for="(grupoEspecialidad, indexEsp) in $store.state.especialidadesUnicas" :key="indexEsp" :label="grupoEspecialidad">
                                                            <option class="text-secondary" v-for="(item3, index3) in getGrupoEquipoSalud(grupoEspecialidad)" :key="index3" :value="item3['id']">{{item3['description']}}</option>
                                                        </optgroup>
                                                    </select>
                                                    <div class="rounded-custom-1 mb-auto mt-1" style="background-color: #efefef !important;">
                                                        <div v-for="(item2,index2) in item['ayudante_3']" :key="index2" class="d-flex align-items-center mt-1">
                                                            <span class="text-secondary mx-1">{{index2+1}}</span>
                                                            <div :class="['flex-fill']">
                                                                {{ item2.description }}
                                                            </div>
                                                            <button @click="destroyIntervencionItem(index,'ayudante_3',index2)" class="ml-1 text-primary btn border-0"><i class="fa fa-times"></i></button>
                                                        </div>
                                                        <div v-if="item['ayudante_3'].length ===0" class="text-center text-secondary rounded p-2 d-flex justify-content-center align-items-center">
                                                            Seleccione Ayudante 3
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4 col-md-3 col-lg-4 d-flex flex-column p-0 pb-1 pr-1">
                                                <label class="label-text text-secondary d-flex" for="">
                                                    Anestesiologo
                                                </label>
                                                <div class="d-flex flex-column">
                                                    <select
                                                        :data-index="index"
                                                        data-ref="anestesiologo"
                                                        :ref="'anestesiologo_'+index"
    
                                                        :class="['form-control bg-gray-footer-parodi']"
                                                    >
    
                                                        <option value="">Seleccione</option>
    
                                                        <optgroup class="text-primary"  v-for="(grupoEspecialidad, indexEsp) in $store.state.especialidadesUnicas.filter(x=>x==='Anestesiología')" :key="indexEsp" :label="grupoEspecialidad">
                                                            <option class="text-secondary" v-for="(item3, index3) in getGrupoEquipoSalud(grupoEspecialidad)" :key="index3" :value="item3['id']">{{item3['description']}}</option>
                                                        </optgroup>
                                                    </select>
                                                    <div class="rounded-custom-1 mb-auto mt-1" style="background-color: #efefef !important;">
                                                        <div v-for="(item2,index2) in item['anestesiologo']" :key="index2" class="d-flex align-items-center mt-1">
                                                            <span class="text-secondary mx-1">{{index2+1}}</span>
                                                            <div :class="['flex-fill']">
                                                                {{ item2.description }}
                                                            </div>
                                                            <button @click="destroyIntervencionItem(index,'anestesiologo',index2)" class="ml-1 text-primary btn border-0"><i class="fa fa-times"></i></button>
                                                        </div>
                                                        <div v-if="item['anestesiologo'].length ===0" class="text-center text-secondary rounded p-2 d-flex justify-content-center align-items-center">
                                                            Seleccione Anestesiologo
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4 col-md-3 col-lg-4 d-flex flex-column p-0 pb-1 pr-1">
    
                                                <label class="mt-auto label-text text-secondary d-flex" for="">
                                                    Equipos Esp<span class="d-sm-block d-none d-lg-none">.</span><span class="d-sm-none d-lg-block">eciales</span>
                                                </label>
                                                <div class="d-flex flex-column">
                                                    <select
                                                        :data-index="index"
                                                        data-ref="equipos_especiales"
                                                        :ref="'equipos_especiales_'+index"
    
                                                        :class="['form-control bg-gray-footer-parodi']"
                                                    >
                                                        <option value="">Seleccione</option>
    
                                                        <option class="text-secondary" v-for="(item3, index3) in $store.state.equipos_especiales_options" :key="index3" :value="item3">{{item3}}</option>
                                                    </select>
                                                    <div class="rounded-custom-1 mb-auto mt-1" style="background-color: #efefef !important;">
                                                        <div v-for="(item2,index2) in item['equipos_especiales']" :key="index2" class="d-flex align-items-center mt-1">
                                                            <span class="text-secondary mx-1">{{index2+1}}</span>
                                                            <div :class="['flex-fill']">
                                                                {{ item2.description }}
                                                            </div>
                                                            <button @click="destroyIntervencionItem(index,'equipos_especiales',index2)" class="ml-1 text-primary btn border-0"><i class="fa fa-times"></i></button>
                                                        </div>
                                                        <div v-if="item['equipos_especiales'].length ===0" class="text-center text-secondary rounded p-2 d-flex justify-content-center align-items-center">
                                                            Seleccione Equipos Esp<span class="d-sm-block d-none">.</span><span class="d-sm-none">eciales</span>
                                                        </div>
                                                    </div>
                                                </div>
    
                                            </div>
                                          </div>
                                        </div>
                                      </div>
    
                                    </div>
                                    <!-- <button @click="destroyItem(index)" :class="[{'d-none':$store.state.formReservacionQuirofano.intervencion.length < 2, }, 'mr-2 align-self-start text-primary btn border-0 ml-2']" ><i class="fa fa-times"></i></button> -->
                                  </div>
                                </div>
                                <button @click="addIntervencion()" class="btn btn-primary mt-2 btn-block"><i class="fa fa-plus"></i> Añadir otra intervención</button>
                            </div>
    
    
    
                            <div class="col-12 col-sm-6">
                                <label class="label-text text-secondary"  for="cat_user_ubicacion_id">Tipo de intervención:</label>
                                <div>
                                    <select
                                    id="level4"
                                    class="form-control bg-gray-footer-parodi mb-1"
                                    ref="level4"
                                    @change="handleDestino(4)"
                                    data-fieldName="area_intervencion"
                                    >
                                    <option  value="">Seleccione</option>
                                    <option v-for="(item,index) in $store.state['catUbicacion'].filter(item=> [418,419].includes(item['id']) )" :key="index" :value="item.id">{{item.coments}}</option>
                                    </select>
                                </div>
                                <div :class="{'d-none':!$store.state.inputLv5}" >
                                    <select
                                        id="level5"
                                        class="form-control bg-gray-footer-parodi mb-1"
                                        ref="level5"
                                        @change="handleDestino(5)"
                                        data-fieldName="area_intervencion"
                                    >
                                        <option value="">Seleccione</option>
                                        <option
                                            v-for="(item,index) in $store.state['ubicaciones_level5']"
                                            :key="index"
                                            :value="item.id"
                                        >
                                            {{item.description}}
                                        </option>
                                    </select>
                                </div>
                                <div :class="{'d-none':!$store.state.inputLv6}" >
                                    <select
                                        id="level6"
                                        class="form-control bg-gray-footer-parodi mb-1"
                                        ref="level6"
                                        @change="handleDestino(6)"
                                        data-fieldName="area_intervencion"
                                    >
                                        <option  value="">Seleccione</option>
                                        <option   v-for="(item,index) in $store.state['ubicaciones_level6']" :key="index" :value="item.id">{{item.description}}</option>
                                    </select>
                                </div>
    
    
                            </div>
    
                            <div class="col-12 col-sm-6">
                                <label class="label-text text-secondary"  for="cat_user_ubicacion_id">Destino:</label>
    
                                <div>
                                    <select
                                    id="level0"
                                    class="form-control bg-gray-footer-parodi mb-1"
                                    ref="level0"
                                    @change="handleDestino(0)"
                                    data-fieldName="destino"
                                    >
                                    <option value="">Seleccione</option>
                                    <option v-for="(item,index) in $store.state['catUbicacion'].filter(item=> ![391,390,246,223,41].includes(item['id']) && item['parent_cat_user_ubicacion_id']===1)" :key="index" :value="item.id">{{item.description}}</option>
                                    </select>
                                </div>
                                <div :class="{'d-none':!$store.state.inputLv1}">
                                    <select
                                        id="level1"
                                        class="form-control bg-gray-footer-parodi mb-1"
                                        ref="level1"
                                        @change="handleDestino(1)"
                                        data-fieldName="destino"
                                    >
                                        <option value="">Seleccione</option>
                                        <option v-for="(item,index) in $store.state['ubicaciones_level1']" :key="index" :value="item.id">{{item.description}}</option>
                                    </select>
                                </div>
                                <div :class="{'d-none':!$store.state.inputLv2}">
                                    <select
                                        id="level2"
                                        class="form-control bg-gray-footer-parodi mb-1"
                                        ref="level2"
                                        @change="handleDestino(2)"
                                        data-fieldName="destino"
                                    >
                                        <option value="">Seleccione</option>
                                        <option v-for="(item,index) in $store.state['ubicaciones_level2']" :key="index" :value="item.id">{{item.description}}</option>
                                    </select>
                                </div>
                                <div :class="{'d-none':!$store.state.inputLv3}">
                                    <select
                                        id="level3"
                                        class="form-control bg-gray-footer-parodi mb-1"
                                        ref="level3"
                                        @change="handleDestino(3)"
                                        data-fieldName="destino"
                                    >
                                        <option value="">Seleccione</option>
                                        <option v-for="(item,index) in $store.state['ubicaciones_level3']" :key="index" :value="item.id">{{item.description}}</option>
                                    </select>
                                </div>
    
    
    
                            </div>
    
                            <div class="col-12 d-none">
                                <div class="form-group"></div>
                                    <label class="label-text text-secondary"  for="aa">Documentos asociados:</label>
                                    <div class="d-flex">
    
                                        <input
                                            @change="handleFileChange"
                                            multiple
                                            type="file"
                                            ref="input_"
                                            class="form-control bg-gray-footer-parodi mr-1"
                                            name="input_"
                                            style="height: 43px;"
                                        >
                                        <button
    
                                            type="button"
                                            class="btn btn-primary font-weight-bold"
                                        >
                                        +
                                        </button>
                                    </div>
                                </div>
                                <div class="container-fluid">
                                    <div class="row">
                                        <div v-for="(item, index) in uploadedFile" :key="index"  class="col-12 col-sm-6">
                                            <div class="list-group-item-input-file my-1 overflow-auto d-flex justify-content-between align-items-center">
                                                <div class="flex-fill d-flex align-items-center">
                                                    <i :class="{'pc-pdf text-danger':item.typeFile=='application/pdf', 'pc-imagenes text-info':item.typeFile=='image/jpeg',   ' m-1 display-3':true}"></i>
                                                    <div class="flex-fill align-items-start d-flex flex-column">
                                                        <input :data-index="index" @input="updateFormFieldFile" v-model="$store.state.formReservacionQuirofano.uploadedFile[index].coments" type="text" class="form-control" placeholder="Describe tu archivo aquí">
                                                        <b class="text-secondary d-flex align-items-center text-left overflow-hidden">
                                                            <i class="fas fa-paperclip mr-1"></i>
                                                            <span>
                                                                {{ item.name }}
                                                            </span>
                                                        </b>
                                                    </div>
                                                </div>
                                                <button @click="destroyFile(index)" class="btn btn-danger mx-1 font-weight-bold" >-</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-1 text-center">
    
                            <button v-if="!edit_solicitudaaaaa" @click="submitForm" id="submit" class="btn btn-success mt-1">Crear solicitud</button>
                            <button v-if="edit_solicitudaaaaa" @click="submitForm" id="submit" class="btn btn-primary mt-1">Actualizar solicitud</button>
                            <button v-if="!edit_solicitudaaaaa" type="button" class="btn btn-info mt-1" @click="resetForm">Limpiar Campos</button>
                        </div>
                </div>
                


            </div>
        </div>
            
    </div>
</template>

<script>
import { get,is_empty,is_null,is_undefined,post } from '../../../../helpers/customHelpers.js';
import { mapState, mapActions } from 'vuex';
import 'select2/dist/css/select2.min.css'; // Importa los estilos CSS de Select2
import 'select2'; // Importa la biblioteca Select2
//import Multiselect from 'vue-multiselect';
//import 'vue-multiselect/dist/vue-multiselect.min.css'; // Importa los estilos CSS
import Todolist from './Todolist.vue'

// Importa la biblioteca Select2
export default {
    props:{
        edit_solicitudaaaaa:{
            type:Boolean,
            default:false
        }
    },
    data() {
        return {
            edad: 0,
            /* numeroSeleccionado: null, */
            numeros: Array.from({ length: 24 }, (_, index) => index + 1), // Genera un arreglo con números del 1 al 24
        };
    },

    components:{
        Todolist,
        //Multiselect
    },
    computed:{
        getComputedIntervenciones(){
            let model = this.$store.state.formReservacionQuirofano.intervencion
            //console.log("intervenciones",model)
            return model

        },

        getCatUbicacionAreas(){

            return  this.$store.state.catUbicacion.filter(item=> [418,419].includes( item['id'] ) ).sort((a, b) => a.orden - b.orden);
        },
        getCatUbicacionAreas2(){
            return  this.$store.state.catUbicacionTemp2.sort((a, b) => a.orden - b.orden);
        },
        getCatUbicacionAreas3(){
            return  this.$store.state.catUbicacionTemp3.sort((a, b) => a.orden - b.orden);
        },
        getCatUbicacionAreas4(){
            return  this.$store.state.catUbicacionTemp4.sort((a, b) => a.orden - b.orden);
        },
        calcularEdad(){
            const fechaNacimiento = new Date(this.$store.state.formReservacionQuirofano.fnacimiento);
            const fechaActual = new Date();

            const diferencia = fechaActual - fechaNacimiento;
            const edadEnMilisegundos = new Date(diferencia);

            // Extraer el año de la fecha de nacimiento
            const edad = Math.abs(edadEnMilisegundos.getUTCFullYear() - 1970);
            //console.log(edad)
            return String(edad) === "NaN" ? 0 : edad;
        },
        equipoCirugiaPrincipales(){
            return this.$store.state.listadoEquipoCirugia
        },
        equipoAnestesiologos(){
            return this.$store.state.listadoAnestesiologos
        },
        uploadedFile(){
            return this.$store.state.formReservacionQuirofano.uploadedFile
        },
        searchingCedula(){
            return this.$store.getters.searchingCedula
        },
    },
    methods: {
        getGrupoEquipoSalud(especialidad){
            let result =  this.$store.state.personal_salud.filter(x=>x['especialidad'] === especialidad )
                return is_empty(result) ? [] : result.map(x=>{
                    return {
                        id:x['user_id'],
                        description:x['medico']
                    }
                }).sort((a, b) => a.description - b.description);
        },
        addIntervencion(){
            let intervencion = this.$store.state.formReservacionQuirofano.intervencion
            let index = intervencion.length -1
                if (is_empty(intervencion[index]['description'])) {
                    alert("Escribe una descripción de la Intervención, procedimiento o estudio a realizar.")
                    //$(this.$refs['description_'+index]).next('.select2').find('.select2-selection').focus()
                    console.log( this.$refs)
                    this.$refs['description_'+index][0].focus()
                    return false
                }
                console.log(intervencion[index]['cirujano_principal'])
                if (intervencion[index]['cirujano_principal'].length === 0) {
                    alert("Selecciona al menos un Cirujano principal.")
                    console.log(  $(this.$refs['cirujano_principal_'+index][0] ) )
                    $(this.$refs['cirujano_principal_'+index][0] ).focus()
                    //this.$refs['cirujano_principal_'+index].focus()
                    return false
                }

                //console.log(intervencion)
                intervencion.push({
                    description:"",
                    cirujano_principal:[],
                    ayudante_1:[],
                    ayudante_2:[],
                    ayudante_3:[],
                    anestesiologo:[],
                    equipos_especiales:[],
                    deleted:false,
                } )

                this.$store.commit('updateFormField', {
                    formName:'formReservacionQuirofano',
                    fieldName:"intervencion",
                    fieldValue: intervencion,
                });

                intervencion = this.$store.state.formReservacionQuirofano.intervencion
                index = intervencion.length -1

                console.log("--->",index)
                this.initSelect2(index)


        },
        destroyItem(item_index){
            let intervencion = this.$store.state.formReservacionQuirofano.intervencion
            let newItems = intervencion.filter((item,index)=>{
                    if(Number(item_index)===Number(index)){
                        item['deleted'] = true
                    }
                    return item
                })

                this.$store.commit('updateFormField', {
                    formName:'formReservacionQuirofano',
                    fieldName:"intervencion",
                    fieldValue: newItems,
                });
        },

        addIntervencionItem(intervencion_index,ref){
            let intervencion = this.$store.state.formReservacionQuirofano.intervencion

            let selected = this.$refs[ref]
                if(is_empty(selected[0].options[ selected[0].options.selectedIndex ].value)){
                    alert("Selecciona una opción")
                    selected[0].focus()
                    return false
                }
                //console.log(selected[0].options[ selected[0].options.selectedIndex ].value)
                intervencion[intervencion_index][ref].push({
                    id:Number(selected[0].options[ selected[0].options.selectedIndex ].value),
                    description:selected[0].options[ selected[0].options.selectedIndex ].text
                })

                this.$store.commit('updateFormField', {
                    formName:'formReservacionQuirofano',
                    fieldName:"intervencion",
                    fieldValue: intervencion,
                });


        },
        destroyIntervencionItem(intervencion_index,ref,item_index){
            let intervencion = this.$store.state.formReservacionQuirofano.intervencion
            let newItems = intervencion[intervencion_index][ref].filter((item,index)=>{
                    if(Number(item_index)!==Number(index)){
                        return item
                    }
                })
                intervencion[intervencion_index][ref] = newItems
                this.$store.commit('updateFormField', {
                    formName:'formReservacionQuirofano',
                    fieldName:"intervencion",
                    fieldValue: intervencion,
                });
        },
        updateIntervencionDescription(intervencion_index,ref){
            let intervencion = this.$store.state.formReservacionQuirofano.intervencion
            let input = this.$refs[ref+'_'+intervencion_index][0]
               //console.log(intervencion_index,ref,input)
                intervencion[intervencion_index][ref] = input.value

                this.$store.commit('updateFormField', {
                    formName:'formReservacionQuirofano',
                    fieldName:"intervencion",
                    fieldValue: intervencion,
                });
        },
        handleDestino(param){
            let resultA = []
            let resultB = false

            let ubicaciones_level = this.$refs['level'+param].value
            let value = ubicaciones_level
            let fieldName = this.$refs['level'+param].dataset['fieldname']
                //console.log("value",value)
                ubicaciones_level = (ubicaciones_level !== "") ? ubicaciones_level.split(",").map(item=>Number(item)) :[]

                if (Number(param) === 0) {

                    for (let index = Number(param); index <= 4; index++) {

                        this.$store.commit("updateProperty",{
                            fieldName:"ubicaciones_level"+index,
                            fieldValue: resultA
                        })
                        this.$store.commit("updateProperty",{
                            fieldName:"inputLv"+index,
                            fieldValue: resultB
                        })
                    }
                }


                if(ubicaciones_level.length > 0){

                resultA =   this.$store.state.catUbicacion
                            .filter(item=> ubicaciones_level.includes( Number(item['parent_cat_user_ubicacion_id']) ) )
                            .map(item=>{
                                return {
                                "id":item.id,
                                "description":item.description+" "+item.coments,
                                "parent_id":item.parent_cat_user_ubicacion_id
                                }
                            })
                if(resultA.length > 0){
                    resultB = true
                }

                }else{

                for (let index = (Number(param)+1); index <= 3; index++) {
                    resultA = []
                    resultB = false
                    for (let index = Number(param); index <= 4; index++) {
                    this.$store.commit("updateProperty",{
                        fieldName:"ubicaciones_level"+index,
                        fieldValue: resultA
                    })
                    this.$store.commit("updateProperty",{
                        fieldName:"inputLv"+index,
                        fieldValue: resultB
                    })
                    }

                }
                }
                console.log(fieldName, value)
                this.$store.commit('updateFormField', {
                    formName:'formReservacionQuirofano',
                    fieldName:fieldName,
                    fieldValue:value,
                });
                this.$store.commit("updateProperty",{
                fieldName:"ubicaciones_level"+(Number(param)+1),
                fieldValue: resultA
                })
                this.$store.commit("updateProperty",{
                fieldName:"inputLv"+(Number(param)+1),
                fieldValue: resultB
                })
            console.log(this.$store.state["ubicaciones_level"+(Number(param)+1)] )
        },
        updateCatUbicacionSub(param){
            let cat_ubicacion_id = Number(this.$refs[param].value)
                return  this.$store.state.catUbicacion.filter(item=>item['parent_cat_user_ubicacion_id']===cat_ubicacion_id).sort((a, b) => a.orden - b.orden);
        },
        updateCatUbicacion(param,nextLevel){

            let cat_ubicacion_id = Number(this.$refs[param].value)

                this.$store.commit('updateFormField', {
                    formName:'formReservacionQuirofano',
                    fieldName:'destino',
                    fieldValue:cat_ubicacion_id,
                });

            let subNivel = this.$store.state.catUbicacion.filter(item=>item['parent_cat_user_ubicacion_id']===this.$store.state.formReservacionQuirofano.destino)
                this.$store.commit('updateProperty', {
                    fieldName: `catUbicacionTemp${nextLevel}` ,
                    fieldValue:subNivel,
                });
                for (let index = nextLevel+1; index <= 4; index++) {
                    this.$store.commit('updateProperty', {
                        fieldName: `catUbicacionTemp${index}` ,
                        fieldValue:[],
                    });
                    this.$store.commit('updateProperty', {
                        fieldName: `lv${index}SelectUbicacion`,
                        fieldValue:false,
                    });
                }

                if(nextLevel < 5){
                    let containItems = subNivel.length > 0
                    let result = false;
                        if(containItems){
                            result = true
                        }
                        this.$store.commit('updateProperty', {
                            fieldName: `lv${nextLevel}SelectUbicacion`,
                            fieldValue:result,
                        });
                }


        },
        async editForm(){
            let edit_solicitud_id=  localStorage.getItem("editSolicitud")
            if(this.$route.path !=="/areaQuirofano/edit_quirofano"){
                localStorage.removeItem("editSolicitud")
            }
            if(this.edit_solicitudaaaaa){

                this.listadoSolicitudesEstaCargando = true
                let solicitud = await get("/areaQuirofano/cupo/edit/"+edit_solicitud_id)
                console.log("solicitud",solicitud)
                if(!is_undefined(solicitud)){

                    this.$store.commit('editFormReservacionQuirofano', solicitud);
                }
                this.listadoSolicitudesEstaCargando = false
                this.$store.commit('updateProperty', {
                        fieldName:'loading',
                        fieldValue:false,
                    });
                //
            }
        },
        async searchCedula(){
            //alert("sss")
            let cedula = this.$store.state.formReservacionQuirofano.cedula
                if (!is_empty(cedula)) {
                    this.$store.commit('searchCedula',true)
                    try {

                        let result = await get(location.origin + "/user/profile/getByCedula/"+ cedula)
                            //console.log( result)
                            if (Object.values(result).length > 0) {
                                for (const key in result) {
                                    if (Object.hasOwnProperty.call(this.$store.state.formReservacionQuirofano, key)) {
                                        this.$store.commit('updateFormField', {
                                            formName:"formReservacionQuirofano",
                                            fieldName:key,
                                            fieldValue:result[key],
                                        });
                                    }
                                }
                            }else{
                                this.resetForm()
                            }
                    } catch (error) {
                        this.$store.commit('searchCedula',false)
                        this.resetForm()
                        console.log(error)
                    }

                }else{
                    this.$store.commit('searchCedula',false)
                    this.resetForm()
                }
                this.$store.commit('updateFormField', {
                    formName:"formReservacionQuirofano",
                    fieldName:'cedula',
                    fieldValue:cedula,
                });
            // Simulación de una carga, podrías usar una función de retardo o una llamada a una API aquí
            setTimeout(() => {
                this.$store.commit('searchCedula',false)
            }, 1000); // Cambiar a
        },
        handleFileChange(event) {
            let files = event.target.files;
            let fileArray = []
            //let temp_files = this.$store.state.formReservacionQuirofano.uploadedFile
            //let result = files.map(x=>Array.from(x))
            for (let index = 0; index < files.length; index++) {
                //console.log(element)
                fileArray.push({
                    id:index,
                    coments:"",
                    name: files[index].name,
                    typeFile:files[index].type,
                    file:files[index]
                })
            }




           // console.log("2--->",fileArray)
            this.$store.commit('SET_FILE', fileArray); // Llama a la mutación para almacenar el archivo en Vuex
        },
        async getAnestesiologos(){

            try {
                let model =  await get(location.origin + '/user/especialidad/{id}/anestesiologo' )
                    this.$store.commit('updateListadoAnestesiologos',model)

            } catch (error) {

                console.error('Error al obtener los datos:', error);
                return []
            }
        },
        async getEquipoCirugia(){

            try {
                //let model =  await get(location.origin + '/medico/getMedicos' )
                let model =  await get(location.origin + '/user/especialidad/{id}/medicos' )
                    this.$store.commit('updateListadoEquipoCirugia',model)
                    this.$store.commit('updateProperty', {
                        fieldName:'loading',
                        fieldValue:false,
                    });
            } catch (error) {

                console.error('Error al obtener los datos:', error);
                return []
            }
        },
        updateFormField(event) {
            this.$store.commit('updateFormField', {
                formName:"formReservacionQuirofano",
                fieldName:event.currentTarget.name,
                fieldValue:event.currentTarget.value,
            });
        },
        updateFormFieldFile(event) {
            this.$store.commit('updateFormFieldFile', {
                index: event.currentTarget.dataset.index,
                fieldValue:event.currentTarget.value,
            });
        },
        destroyFile(index){
            //console.log(index)
            let indiceAEliminar = index; // Índice del objeto que deseas eliminar
            let temp_object = this.$store.state.formReservacionQuirofano.uploadedFile
            //console.log(temp_object)
                temp_object = temp_object.filter((item, key) => item.id === Number(indiceAEliminar))

                //temp_object = JSON.stringify(temp_object)
                this.$store.commit('updateFormFiles', {
                    fieldName:'uploadedFile',
                    fieldValue:temp_object
                });

        },
        validate() {
            if (['',null].includes(this.$store.state.formReservacionQuirofano['cedula'])) {
                Swal.fire({
                    icon: "warning",
                    title: "Una cédula es requerida.",
                    didClose: () => {
                        setTimeout(() => this.$refs[ 'cedula' ].focus(), 110);
                    }
                })
                return false
            }
            if (['',null].includes(this.$store.state.formReservacionQuirofano['nombres'])) {
                Swal.fire({
                    icon: "warning",
                    title: "Los nombres del paciente son requeridos.",
                    didClose: () => {
                        setTimeout(() => this.$refs[ 'nombres' ].focus(), 110);
                    }
                })
                return false
            }
            if (['',null].includes(this.$store.state.formReservacionQuirofano['apellidos'])) {
                Swal.fire({
                    icon: "warning",
                    title: "Los apellidos del paciente son requeridos.",
                    didClose: () => {
                        setTimeout(() => this.$refs[ 'apellidos' ].focus(), 110);
                    }
                })
                return false
            }
            if (['',null].includes(this.$store.state.formReservacionQuirofano['fnacimiento'])) {
                Swal.fire({
                    icon: "warning",
                    title: "La fecha de nacimiento del paciente es requerida.",
                    didClose: () => {
                        setTimeout(() => this.$refs[ 'fnacimiento' ].focus(), 110);
                    }
                })
                return false
            }

            if (['',null].includes(this.$store.state.formReservacionQuirofano['n_presupuesto'])) {
                Swal.fire({
                    icon: "warning",
                    title: "Un número de presupuesto es requerido.",
                    didClose: () => {
                        setTimeout(() => this.$refs[ 'n_presupuesto' ].focus(), 110);
                    }
                })
                return false
            }
            if (['',null].includes(this.$store.state.formReservacionQuirofano['fecha_reservacion'])) {
                Swal.fire({
                    icon: "warning",
                    title: "La fecha programada es requerida.",
                    didClose: () => {
                        setTimeout(() => this.$refs[ 'fecha_reservacion' ].focus(), 110);
                    }
                })
                return false
            }
            if (['',null].includes(this.$store.state.formReservacionQuirofano['h_inicio'])) {
                Swal.fire({
                    icon: "warning",
                    title: "La hora de inicio de la programación es requerida.",
                    didClose: () => {
                        setTimeout(() => this.$refs[ 'h_inicio' ].focus(), 110);
                    }
                })
                return false
            }
            if ([,'',null].includes(this.$store.state.formReservacionQuirofano['h_fin'])) {
                Swal.fire({
                    icon: "warning",
                    title: "La hora estimada de fin de la programación es requerida.",
                    didClose: () => {
                        setTimeout(() => this.$refs[ 'h_fin' ].focus(), 110);
                    }
                })
                return false
            }

            if (this.$store.state.formReservacionQuirofano['intervencion'].length === 0 ) {
                Swal.fire({
                    icon: "warning",
                    title: "Escribe y confirma, al menos una intervención a realizar.",
                    didClose: () => {
                        setTimeout(() => this.$refs['intervencion'].childRef().focus(), 110);
                    }
                })
            }else{
                let key = true
                let alerta = {
                        icon:"warning",
                        title:"",
                        retorna:true
                    }
                let intervenciones = this.$store.state.formReservacionQuirofano['intervencion']
                    intervenciones.forEach(intervencion=>{
                        for (const key in intervencion) {
                            console.log(key)
                            if (key === 'description' && alerta.retorna) {
                                if (intervencion[key] ==="") {
                                    alerta.title ="Escribe y confirma, al menos una Intervención, procedimiento o estudio a realizar.",
                                    alerta.retorna = false
                                }
                            }
                            if (key === 'cirujano_principal' && alerta.retorna) {
                                if (intervencion[key].length ===0) {
                                    alerta.title ="Selecciona y confirma, al menos un cirujano principal",
                                    alerta.retorna = false
                                }
                            }



                        }

                    })
                    if(!alerta.retorna){
                        Swal.fire({
                            icon: alerta.icon,
                            title: alerta.title,

                        })
                        return false
                    }else{

                        if (['',null].includes(this.$store.state.formReservacionQuirofano['area_intervencion'])) {
                            Swal.fire({
                                icon: "warning",
                                title: "Un área de intervención es requerida.",
                                didClose: () => {
                                    setTimeout(() => this.$refs[ 'area_intervencion' ].focus(), 110);
                                }
                            })
                            return false
                        }



                        return true
                    }


            }


        },
        resetForm() {
            this.$store.commit('resetForm');
        },
        async submitForm() {
            //console.log(location)
            if (this.validate()) {
                if (['',null,"[]"].includes(this.$store.state.formReservacionQuirofano['anestesiologo'])) {
                    this.$store.commit('updateFormFiles', {
                        fieldName:'anestesiologo',
                        fieldValue: JSON.stringify([{"id":"0","description":"SERVICIO DE ANESTESIA"}])
                    });
                }
                let formulario =this.$store.state.formReservacionQuirofano
                    console.log(formulario)
                let formdata = new FormData()
                    for (const key in this.$store.state.formReservacionQuirofano) {

                        let element = this.$store.state.formReservacionQuirofano[key];
                            if(key==="intervencion"){
                                element = JSON.stringify( this.$store.state.formReservacionQuirofano[key].filter(x=>!x['deleted']) )
                            }
                            formdata.append(key, element)

                    }
                    console.log(formulario)
                    /* formdata.append("user_id_paciente", 22) */
                let user_id = this.$store.state.formReservacionQuirofano['user_id']
                    formdata.append("user_id", is_null(user_id) ? null : Number(user_id) )
                    //formdata.append("user_id_medico", 22)
                    formdata.append("_token", document.querySelector('meta[name="csrf-token"]').getAttribute('content') )
                    //console.log(formdata)

                    let result= ""
                        this.$store.commit('updateProperty', {
                            fieldName:'loading',
                            fieldValue:true,
                        });
                        if(this.$route.path=="/areaQuirofano/edit_quirofano"){
                            result = await post(location.origin + "/areaQuirofano/updateForm", formdata)
                        }else{
                            result = await post(location.origin + "/areaQuirofano/store", formdata)
                        }
                        this.$store.commit('updateProperty', {
                            fieldName:'loading',
                            fieldValue:false,
                        });


                        this.resetForm()
                    Swal.fire({
                        icon: "success",
                        title: "Programación guardada",
                        text:"Los datos de la nueva programación pueden verse en la pantalla del Plan quirúrgico Programado.",
                        didClose: () => {
                            this.$store.commit('updateProperty', {
                                fieldName:'loading',
                                fieldValue:false,
                            });
                            localStorage.removeItem("editSolicitud")
                            setTimeout(() => this.$router.push('/areaQuirofano/index_quirofano') /*location.href = location.origin + "/areaQuirofano/index_quirofano"*/ , 110);
                        }
                    })
                //console.log(result)
            }
            // Aquí podrías realizar acciones adicionales, como enviar datos a un servidor
            console.log('Form submitted:', this.formData);
            //this.resetForm();
        },
        async initSelect2(id){

           let miFuncion = (selected)=>{
                    let selectedValue = selected.val();
                    let selectedText = selected.find('option:selected').text();
                    let ref = selected.data('ref');
                    let index = selected.data('index');
                    let intervencion = this.$store.state.formReservacionQuirofano.intervencion


                    //console.log(selectedValue)
                    //console.log(selectedText)
                    if(is_empty(selectedValue)){
                        alert("Selecciona una opción")
                        selected.focus()
                        return false
                    }
                    //console.log(selected[0].options[ selected[0].options.selectedIndex ].value)
                    intervencion[index][ref].push({
                        id:Number(selectedValue),
                        description:selectedText
                    })

                    this.$store.commit('updateFormField', {
                        formName:'formReservacionQuirofano',
                        fieldName:"intervencion",
                        fieldValue: intervencion,
                    });
                }


                setTimeout(() => {
                    let array = [
                            'cirujano_principal_'+id,
                            'anestesiologo_'+id,
                            'equipos_especiales_'+id,
                            'ayudante_1_'+id,
                            'ayudante_2_'+id,
                            'ayudante_3_'+id,
                        ]

                        array.forEach(element => {
                            $( this.$refs[ element ] ).select2();
                            $( this.$refs[ element ] ).on('change', function() {
                                miFuncion($(this))
                            });
                        });



                }, 1000);




        }
    },
    /* created() {

    }, */
    mounted: async function () {

        await this.getAnestesiologos()
        await this.getEquipoCirugia()
        this.$store.commit('updateEspecialidadesUnicas')


        // Inicializa Select2 en el elemento ref "selectElement"
        this.initSelect2(0)
        /*
        $( this.$refs['anestesiologo'].childRef() ).select2();
        $( this.$refs['equipos_especiales'].childRef() ).select2();
        $( this.$refs['ayudante_1'].childRef() ).select2();
        $( this.$refs['ayudante_2'].childRef() ).select2();
        $( this.$refs['ayudante_3'].childRef() ).select2(); */

        /* $(this.$refs['equipos_especiales'].childRef()).on('select2:select', function (e) {
            //console.log(e.target.value)

            let otroInput = document.querySelector("#otros_equipos_especiales")
                if (e.target.value ==="Otros") {
                    otroInput.classList.replace("d-none","d-block")
                }else{
                    otroInput.classList.replace("d-block","d-none")
                }

        }); */
        let that = this
        /*  $(this.$refs['cirujano_principal'].childRef()).on('select2:select', function (e) {
            let {tagValueText,messageAlert} = that.$refs['cirujano_principal'].childRef().dataset
            that.executeHandleInput(tagValueText,messageAlert)
        }); */

        this.$refs[ 'cedula' ].focus()

        this.editForm()
    },
    updated(){
        /* let intervencion = this.$store.state.formReservacionQuirofano.intervencion
        let index = intervencion.length -1

            console.log(index)
            this.initSelect2(index)
            this.$forceUpdate(); */
    },
    beforeDestroy() {
        // Destruye Select2 al desmontar el componente
        //$( this.$refs['cirujano_principal'].childRef() ).select2('destroy');
        //$( this.$refs['anestesiologo'].childRef() ).select2('destroy');
        //$( this.$refs['equipos_especiales'].childRef() ).select2('destroy');
    }
}
</script>

<style lang="scss" scoped>
.title-option-page{
    font-size: 1.2rem;
    font-weight:600;
  }
.btn-primary-custom {
    color: #ffffff;
    background-color: #5b96df !important;
}
.list-group-item-input-file,
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
