
<div class="row p-3">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <a data-toggle="collapse" href="#caja2" role="button" aria-expanded="false"
            aria-controls="caja2">
            <h1 class="display-5 text-primary"  style="font-size: 2rem !important;font-weight: 400 !important;">
                Ficha Médica <i class="fa fa-chevron-down text-secondary"
                    aria-hidden="true"></i></h1>
        </a>
        <div class="collapse multi-collapse" id="caja2">
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    <br>
                    <div class="form-group">
                        <label class=" mb-1 text-secondary text-size-sintoma"
                            for="pregunta">
                            ¿Está usted tomando algún<br>
                            medicamento de forma permanente?
                        </label>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <select onchange="showHide('#cat_user_cuestionario_61_coment')"  name="cat_user_cuestionario_61" id="cat_user_cuestionario_61" class="form-control form-control-lg bg-gray-footer-parodi">
                                    <option value="No">No</option>
                                    <option value="Si">Si</option>
                                </select>
                                <textarea class="form-control" style="display: none" placeholder="Indique el/los medicamento(s), con su concentración, presentacion, en indicación." name="cat_user_cuestionario_61_coment" id="cat_user_cuestionario_61_coment" rows="3"></textarea>
                                <small id="helpId1" class="form-text text-muted"></small>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    <br>
                    <div class="form-group">
                        <label class=" mb-1 text-secondary text-size-sintoma"
                            for="pregunta">
                            ¿Es usted <br>
                            alergico?
                        </label>

                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">


                            <div class="form-group">
                                <select onchange="showHide('#cat_user_cuestionario_62_coment')"  name="cat_user_cuestionario_62" id="cat_user_cuestionario_62" class="form-control form-control-lg bg-gray-footer-parodi">
                                    <option value="No">No</option>
                                    <option value="Si">Si</option>
                                </select>
                                <textarea class="form-control" style="display: none" placeholder="Indique las alergias que posee." name="cat_user_cuestionario_62_coment" id="cat_user_cuestionario_62_coment" rows="3"></textarea>
                                <small id="helpId1" class="form-text text-muted"></small>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                    <div class="form-group">
                        <label class=" mb-1 text-secondary text-size-sintoma"
                            for="pregunta">
                            ¿Está usted tomando algún medicamento en este momento?
                        </label>
                    </div>
                    <div class="form-group">
                        <select onchange="showHide('#div_medicamnto_actual')"  name="cat_user_cuestionario_63" id="cat_user_cuestionario_63" class="form-control form-control-lg bg-gray-footer-parodi">
                            <option value="No">No</option>
                            <option value="Si">Si</option>
                        </select>
                        @php
                            use App\Models\CatUserCuestionario;
                            $medicacionPrevia = CatUserCuestionario::getMedicacionPrevia();
                            $totalItemsXColumnas = ceil(count($medicacionPrevia->all())/4);

                            $imagenologia = CatUserCuestionario::getImagenologia();
                            $totalItemsXColumnas2 = ceil(count($imagenologia->all())/3);

                        @endphp
                        <div id="div_medicamnto_actual" style="display: none">
                            <div class="row  mt-3">
                                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                    @php($count=1)

                                    @foreach ($medicacionPrevia->all() as $key => $item)

                                        <div
                                            class="custom-control custom-checkbox"
                                            @if ($item->id==71)
                                                onclick="$('#cat_user_cuestionario_71_coment').show('slow')"
                                            @endif
                                            >
                                            <input type="checkbox"  class="custom-control-input" value="{{$item->id}}" id="cat_user_cuestionario_{{$item->id}}" name="cat_user_cuestionario_{{$item->id}}">
                                            <label class="custom-control-label text-size-sintoma text-secondary" for="cat_user_cuestionario_{{$item->id}}">{{$item->description}}</label>
                                        </div>
                                        @if ($count==$totalItemsXColumnas)
                                            </div>
                                            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                            @php($count=0)
                                        @endif

                                        @php($count++)

                                    @endforeach
                                </div>


                            </div>
                        </div>
                        <textarea class="form-control" style="display: none" placeholder="Indique el/los medicamento(s), con su concentración, presentacion, en indicación." name="cat_user_cuestionario_71_coment" id="cat_user_cuestionario_71_coment" rows="3"></textarea>
                        <small id="helpId1" class="form-text text-muted"></small>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
                    <div class="form-group">
                        <label class="label-text text-secondary" for="cat_user_cuestionario_72">Peso</label>
                        <div class="input-group">
                            <input type="number" name="cat_user_cuestionario_72" class="form-control form-control-lg bg-gray-footer-parodi" id="cat_user_cuestionario_72">
                            <div class="input-group-prepend">
                                <div class="input-group-text">kg</div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="text-secondary text-size-sintoma" for="cat_user_cuestionario_73">Oximetría</label>
                        <input type="text" class="form-control form-control-lg bg-gray-footer-parodi" name="cat_user_cuestionario_73" id="cat_user_cuestionario_73" aria-describedby="helpId" placeholder="">
                        <small id="helpId1" class="form-text text-muted"></small>
                    </div>

                    <div class="form-group">
                        <label class="text-secondary text-size-sintoma" for="cat_user_cuestionario_74">FC</label>
                        <input type="text" class="form-control form-control-lg bg-gray-footer-parodi" name="cat_user_cuestionario_74" id="cat_user_cuestionario_74" aria-describedby="helpId" placeholder="">
                        <small id="helpId1" class="form-text text-muted"></small>
                    </div>

                    <div class="form-group">
                        <label class="text-secondary text-size-sintoma" for="cat_user_cuestionario_75">Escala de glasgow</label>
                        <input type="text" class="form-control form-control-lg bg-gray-footer-parodi" name="cat_user_cuestionario_75" id="cat_user_cuestionario_75" aria-describedby="helpId" placeholder="">
                        <small id="helpId1" class="form-text text-muted"></small>
                    </div>

                </div>
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
                    <div class="form-group">
                        <label class="label-text text-secondary" for="cat_user_cuestionario_76">Talla</label>
                        <div class="input-group">
                            <input type="number" name="cat_user_cuestionario_76" class="form-control form-control-lg bg-gray-footer-parodi"
                                id="cat_user_cuestionario_76">
                            <div class="input-group-prepend">
                                <div class="input-group-text">cm</div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="text-secondary text-size-sintoma" for="cat_user_cuestionario_77">TA (sistólica)</label>
                        <input type="text" class="form-control form-control-lg bg-gray-footer-parodi" name="cat_user_cuestionario_77" id="cat_user_cuestionario_77" aria-describedby="helpId" placeholder="">
                        <small id="helpId1" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label class="text-secondary text-size-sintoma" for="cat_user_cuestionario_78">SpO2</label>
                        <input type="text" class="form-control form-control-lg bg-gray-footer-parodi" name="cat_user_cuestionario_78" id="cat_user_cuestionario_78" aria-describedby="helpId" placeholder="">
                        <small id="helpId1" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label class="text-secondary text-size-sintoma" for="cat_user_cuestionario_79">SOFA</label>
                        <input type="text" class="form-control form-control-lg bg-gray-footer-parodi" name="cat_user_cuestionario_79" id="cat_user_cuestionario_79" aria-describedby="helpId" placeholder="">
                        <small id="helpId1" class="form-text text-muted"></small>
                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
                    <div class="form-group">
                        <label class="label-text text-secondary" for="cat_user_cuestionario_80">IMC</label>
                        <div class="input-group">
                            <input type="number" name="cat_user_cuestionario_80" class="form-control form-control-lg bg-gray-footer-parodi" id="cat_user_cuestionario_80">

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="text-secondary text-size-sintoma" for="cat_user_cuestionario_81">TA (diastólica)</label>
                        <input type="text" class="form-control form-control-lg bg-gray-footer-parodi" name="cat_user_cuestionario_81" id="cat_user_cuestionario_81" aria-describedby="helpId" placeholder="">
                        <small id="helpId1" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label class="text-secondary text-size-sintoma" for="cat_user_cuestionario_82">FIO2</label>
                        <input type="text" class="form-control form-control-lg bg-gray-footer-parodi" name="cat_user_cuestionario_82" id="cat_user_cuestionario_82" aria-describedby="helpId" placeholder="">
                        <small id="helpId1" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label class="label-text text-secondary" for="cat_user_cuestionario_83">Grupo sanguineo</label>
                        <select class="form-control form-control-lg bg-gray-footer-parodi" name="cat_user_cuestionario_83"
                            id="cat_user_cuestionario_83" aria-describedby="helpId" placeholder=""></select>
                        <small id="helpId1" class="form-text text-muted"></small>
                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
                    <div class="form-group">
                        <label class="text-secondary text-size-sintoma" for="cat_user_cuestionario_84">Temperatura</label>
                        <input type="number" class="form-control form-control-lg bg-gray-footer-parodi" name="cat_user_cuestionario_84" id="cat_user_cuestionario_84" aria-describedby="helpId" placeholder="">
                        <small id="helpId1" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label class="text-secondary text-size-sintoma" for="cat_user_cuestionario_85">FR</label>
                        <input type="text" class="form-control form-control-lg bg-gray-footer-parodi" name="cat_user_cuestionario_85" id="cat_user_cuestionario_85" aria-describedby="helpId" placeholder="">
                        <small id="helpId1" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label class="text-secondary text-size-sintoma" for="cat_user_cuestionario_86">SpO2/FIO2</label>
                        <input type="text" class="form-control form-control-lg bg-gray-footer-parodi" name="cat_user_cuestionario_86" id="cat_user_cuestionario_86" aria-describedby="helpId" placeholder="">
                        <small id="helpId1" class="form-text text-muted"></small>
                    </div>
                </div>

            </div>


            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label class="label-text text-secondary" for="cat_user_cuestionario_87" style="">Motivo de consulta</label>
                        <textarea class="form-control form-control-lg bg-gray-footer-parodi" name="cat_user_cuestionario_87" id="cat_user_cuestionario_87" rows="3"></textarea>
                        <small id="helpId1" class="form-text text-muted"></small>

                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label class="label-text text-secondary" for="cat_user_cuestionario_88">Enfermedad Actual</label>
                        <textarea class="form-control form-control-lg bg-gray-footer-parodi" name="cat_user_cuestionario_88" id="cat_user_cuestionario_88" rows="3"></textarea>
                        <small id="helpId1" class="form-text text-muted"></small>

                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="form-group">
                        <label class="label-text text-secondary mt-2" for="cat_user_cuestionario_89" style="">Examen físico</label>
                        <textarea class="form-control form-control-lg bg-gray-footer-parodi" name="cat_user_cuestionario_89" id="cat_user_cuestionario_89" rows="3"></textarea>
                        <small id="helpId1" class="form-text text-muted"></small>

                    </div>
                </div>
            </div>
            <label class="text-secondary text-size-sintoma mt-4" for="pregunta4" style="">Laboratorio</label>
            <div class="row">
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
                    <div class="form-group">
                        <label class="label-text text-secondary mt-2" for="cat_user_cuestionario_90" style=""></label>
                        <input class="form-control form-control-lg bg-gray-footer-parodi" name="" id="">
                        <small id="helpId1" class="form-text text-muted"></small>

                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
                    <div class="form-group">
                        <label class="label-text text-secondary mt-2" for="cat_user_cuestionario_90" style=""></label>
                        <input class="form-control form-control-lg bg-gray-footer-parodi" name="" id="">
                        <small id="helpId1" class="form-text text-muted"></small>

                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
                    <div class="form-group">
                        <label class="label-text text-secondary mt-2" for="cat_user_cuestionario_90" style=""></label>
                        <input class="form-control form-control-lg bg-gray-footer-parodi" name="" id="">
                        <small id="helpId1" class="form-text text-muted"></small>

                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
                    <div class="form-group">
                        <label class="label-text text-secondary mt-2" for="cat_user_cuestionario_90" style=""></label>
                        <input class="form-control form-control-lg bg-gray-footer-parodi" name="" id="">
                        <small id="helpId1" class="form-text text-muted"></small>

                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
                    <div class="form-group">
                        <label class="label-text text-secondary mt-2" for="cat_user_cuestionario_90" style=""></label>
                        <input class="form-control form-control-lg bg-gray-footer-parodi" name="" id="">
                        <small id="helpId1" class="form-text text-muted"></small>

                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
                    <div class="form-group">
                        <label class="label-text text-secondary mt-2" for="cat_user_cuestionario_90" style=""></label>
                        <input class="form-control form-control-lg bg-gray-footer-parodi" name="" id="">
                        <small id="helpId1" class="form-text text-muted"></small>

                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
                    <div class="form-group">
                        <label class="label-text text-secondary mt-2" for="cat_user_cuestionario_90" style=""></label>
                        <input class="form-control form-control-lg bg-gray-footer-parodi" name="" id="">
                        <small id="helpId1" class="form-text text-muted"></small>

                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
                    <div class="form-group">
                        <label class="label-text text-secondary mt-2" for="cat_user_cuestionario_90" style=""></label>
                        <input class="form-control form-control-lg bg-gray-footer-parodi" name="" id="">
                        <small id="helpId1" class="form-text text-muted"></small>

                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
                    <div class="form-group">
                        <label class="label-text text-secondary mt-2" for="cat_user_cuestionario_90" style=""></label>
                        <input class="form-control form-control-lg bg-gray-footer-parodi" name="" id="">
                        <small id="helpId1" class="form-text text-muted"></small>

                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
                    <div class="form-group">
                        <label class="label-text text-secondary mt-2" for="cat_user_cuestionario_90" style=""></label>
                        <input class="form-control form-control-lg bg-gray-footer-parodi" name="" id="">
                        <small id="helpId1" class="form-text text-muted"></small>

                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
                    <div class="form-group">
                        <label class="label-text text-secondary mt-2" for="cat_user_cuestionario_90" style=""></label>
                        <input class="form-control form-control-lg bg-gray-footer-parodi" name="" id="">
                        <small id="helpId1" class="form-text text-muted"></small>

                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
                    <div class="form-group">
                        <label class="label-text text-secondary mt-2" for="cat_user_cuestionario_90" style=""></label>
                        <input class="form-control form-control-lg bg-gray-footer-parodi" name="" id="">
                        <small id="helpId1" class="form-text text-muted"></small>

                    </div>
                </div>
            </div>
            <label class="text-secondary text-size-sintoma mt-4" for="pregunta4" style="">Pruebas</label>

            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                    <div class="form-group">
                        <label class="text-secondary text-size-sintoma" for="cat_user_cuestionario_91" style="">¿Le realizaron prueba PDR?</label>
                        <select onchange="showHide('.pdr')" name="cat_user_cuestionario_91" id="cat_user_cuestionario_91" class="form-control form-control-lg bg-gray-footer-parodi">
                            <option value="No">No</option>
                            <option value="Si">Si</option>
                        </select>
                        <small id="helpId1" class="form-text text-muted"></small>
                    </div>
                </div>

                <div  class="col-xs-2 col-sm-2 col-md-4 col-lg-2 col-xl-2">
                    <div style="display:none" class="pdr form-group">
                      <label class="text-secondary text-size-sintoma" for="cat_user_cuestionario_92">Fecha</label>
                      <input type="date" name="cat_user_cuestionario_92" id="cat_user_cuestionario_92"  class="form-control form-control-lg bg-gray-footer-parodi" placeholder="" aria-describedby="helpId">
                      <small id="helpId1" class="form-text text-muted"></small>
                    </div>
                </div>
                <div class="col-xs-2 col-sm-4 col-md-2 col-lg-2 col-xl-2">
                    <div style="display:none" class="pdr form-group">
                        <label class="text-secondary text-size-sintoma" for="cat_user_cuestionario_93" style="">Resultado</label>
                        <select name="cat_user_cuestionario_93" id="cat_user_cuestionario_93" class="form-control form-control-lg bg-gray-footer-parodi">
                            <option value="Positivo">Positivo</option>
                            <option value="Negativo">Negativo</option>
                            <option value="Indeterminado">Indeterminado</option>
                            <option value="No sabe">No sabe</option>
                        </select>
                        <small id="helpId1" class="form-text text-muted"></small>
                    </div>
                </div>
                <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1">
                    <div  style="display:none;padding-top: 50px;" class="pdr custom-control custom-checkbox" style="margin-top: 45px;">
                        <input type="checkbox"  class="custom-control-input" value="Si" id="cat_user_cuestionario_94" name="cat_user_cuestionario_94">
                        <label class="custom-control-label text-size-sintoma text-secondary" for="cat_user_cuestionario_94">IgM</label>
                    </div>
                </div>
                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                    <div style="display:none" class="pdr form-group">
                        <label class="text-secondary text-size-sintoma" for="cat_user_cuestionario_123" style="">Resultado</label>
                        <select name="cat_user_cuestionario_123" id="cat_user_cuestionario_123" class="form-control form-control-lg bg-gray-footer-parodi">
                            <option value="Positivo">Positivo</option>
                            <option value="Negativo">Negativo</option>
                            <option value="Indeterminado">Indeterminado</option>
                            <option value="No sabe">No sabe</option>
                        </select>
                        <small id="helpId1" class="form-text text-muted"></small>
                    </div>
                </div>
                <div class="col-xs-1 col-sm-1 col-md-21col-lg-1 col-xl-1">
                    <div  style="display:none;padding-top: 50px;" class="pdr custom-control custom-checkbox" style="margin-top: 45px;">
                        <input type="checkbox"  class="custom-control-input" value="Si" id="cat_user_cuestionario_95" name="cat_user_cuestionario_95">
                        <label class="custom-control-label text-size-sintoma text-secondary" for="cat_user_cuestionario_95">IgG</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                    <div class="form-group">
                        <label class="text-secondary text-size-sintoma" for="cat_user_cuestionario_96" style="">¿Le realizaron prueba PCR?</label>
                        <select onchange="showHide('.pcr')" name="cat_user_cuestionario_96" id="cat_user_cuestionario_96" class="form-control form-control-lg bg-gray-footer-parodi">
                            <option value="No">No</option>
                            <option value="Si">Si</option>
                        </select>
                        <small id="helpId1" class="form-text text-muted"></small>
                    </div>
                </div>
                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                    <div style="display:none;" class="pcr form-group">
                      <label class="text-secondary text-size-sintoma" for="cat_user_cuestionario_97">Fecha</label>
                      <input type="date" name="cat_user_cuestionario_97" id="cat_user_cuestionario_97" class="form-control form-control-lg bg-gray-footer-parodi" placeholder="" aria-describedby="helpId">
                      <small id="helpId1" class="form-text text-muted"></small>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div style="display:none;" class="pcr form-group">
                        <label class="text-secondary text-size-sintoma" for="cat_user_cuestionario_98" style="">Resultado</label>
                        <select name="cat_user_cuestionario_98" id="cat_user_cuestionario_98" class="form-control form-control-lg bg-gray-footer-parodi">
                            <option value="Positivo">Positivo</option>
                            <option value="Negativo">Negativo</option>
                            <option value="Indeterminado">Indeterminado</option>
                            <option value="No sabe">No sabe</option>
                        </select>
                        <small id="helpId1" class="form-text text-muted"></small>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-612col-md-12 col-lg-12 col-xl-12">
                    <div class="form-group">
                        <label class="label-text text-secondary" for="cat_user_cuestionario_99"></label>
                        <textarea class="form-control form-control-lg bg-gray-footer-parodi" name="cat_user_cuestionario_99" id="cat_user_cuestionario_99" rows="3"></textarea>
                        <small id="helpId1" class="form-text text-muted"></small>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-612col-md-12 col-lg-12 col-xl-12">
                    <div class="form-group">
                        <label class="label-text text-secondary mt-2" for="cat_user_cuestionario_100">Imagenes</label>


                    </div>
                </div>

            </div>
            <div class="row  mt-3">
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    @php($count=1)

                    @foreach ($imagenologia->all() as $key => $item)

                        <div
                            class="custom-control custom-checkbox"
                            @if ($item->id==122)
                                onclick="$('#cat_user_cuestionario_122_otro').show('slow')"
                            @endif
                            >
                            <input type="checkbox"  class="custom-control-input" value="{{$item->id}}" id="cat_user_cuestionario_{{$item->id}}" name="cat_user_cuestionario_{{$item->id}}">
                            <label class="custom-control-label text-size-sintoma text-secondary" for="cat_user_cuestionario_{{$item->id}}">{{$item->description}}</label>
                        </div>
                        @if ($count==$totalItemsXColumnas2)
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                            @php($count=0)
                        @endif

                        @php($count++)

                    @endforeach
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <textarea style="display: none" class="form-control form-control-lg bg-gray-footer-parodi" name="cat_user_cuestionario_122_otro" id="cat_user_cuestionario_122_otro" rows="3"></textarea>
                    <small id="helpId1" class="form-text text-muted"></small>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label class=" mb-1 text-secondary text-size-sintoma" for="cat_user_cuestionario_101" style="">Probabilidad diagnóstica</label>
                        <textarea class="form-control form-control-lg bg-gray-footer-parodi" name="cat_user_cuestionario_101" id="cat_user_cuestionario_101" rows="3"></textarea>
                        <small id="helpId1" class="form-text text-muted"></small>
                    </div>
                </div>

                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label class=" mb-1 text-secondary text-size-sintoma" for="cat_user_cuestionario_102">Plan</label>
                        <textarea class="form-control form-control-lg bg-gray-footer-parodi" name="cat_user_cuestionario_102" id="cat_user_cuestionario_102" rows="3"></textarea>
                        <small id="helpId1" class="form-text text-muted"></small>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
