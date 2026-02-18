@extends('component.template')

@section('title')
    CMDLT | PatientCare
@endsection
@section('header')
    @include('component.menu_principal')
@endsection
@section('menu_2')
    @if (!is_null(session('userData')))
        @include('component.menu_user')
    @endif
@endsection
@section('content')
    @yield('menu_2')
    <div id="clasificador" class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div>
                    <h1 class="text-primary">
                        Clasificador Internacional de Enfermedades (CIE11)
                    </h1>
                </div>

            </div>
        </div>

        @php
            $identificador = 0;
        @endphp

        <!-- datos del paciente -->
        <div class="row">
            <div class="col-md-12">
                <div class="mt-3">
                    <div class="h5 text-primary">
                        Datos del paciente
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <td style="width:70%;px;text-align:center;color:var(--secondary);font-size: 1rem;padding: 0.25rem !important;width:150px;line-height: 2;">
                                    Paciente
                                </td>
                                <td style="width:10%;text-align:center;color:var(--secondary);font-size: 1rem;padding: 0.25rem !important;line-height: 2;">
                                    Cédula
                                </td>
                                <td style="width:10%;text-align:center;color:var(--secondary);font-size: 1rem;padding: 0.25rem !important;line-height: 2;">
                                    Sexo
                                </td>
                                <td style="width:10%;text-align:center;color:var(--secondary);font-size: 1rem;padding: 0.25rem !important;line-height: 2;">
                                    Edad
                                </td>
                            </tr>
                            <tr>
                                <td class="p-1">
                                    <input value="{{ $paciente->paciente }}"  type="text" class=" text-center form-control bg-light border-0">
                                </td>
                                <td class="p-1">
                                    <input value="{{ $paciente->cedula }}"  type="text" class="text-center form-control bg-light border-0">
                                </td>
                                <td class="p-1">
                                    <input value="{{ $paciente->sexo }}"  type="text" class="text-center form-control bg-light border-0">
                                </td>
                                <td class="p-1">
                                    <input value="{{ $paciente->edad }}"  type="text" class="text-center form-control bg-light border-0">
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- datos de hospitalizacion -->
        <div class="row">
            <div class="col-md-12">
                <div class="mt-3">
                    <div class="h5 text-primary">
                        Datos de hospitalización
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <td style="width:25%;px;text-align:center;color:var(--secondary);font-size: 1rem;padding: 0.25rem !important;width:150px;line-height: 2;">
                                    Fecha de Ingreso
                                </td>
                                <td style="width:25%;px;text-align:center;color:var(--secondary);font-size: 1rem;padding: 0.25rem !important;line-height: 2;">
                                    Fecha de Egreso
                                </td>
                                <td style="width:25%;text-align:center;color:var(--secondary);font-size: 1rem;padding: 0.25rem !important;line-height: 2;">
                                    Días de hospitalización
                                </td>
                                <td style="width:25%;text-align:center;color:var(--secondary);font-size: 1rem;padding: 0.25rem !important;line-height: 2;">
                                    Habitación
                                </td>
                            </tr>
                            <tr>
                                <td class="p-1 ">
                                    <input id="ingreso" onchange="UserCuestEpisodio.update2(this.id)" value="{{ date('Y-m-d', strtotime($ultimo_egreso->ingreso))  }}"  type="date" class=" text-center form-control bg-light border-0">
                                    <small class="help_ingreso"></small>
                                </td>
                                <td class="p-1">
                                    <input id="egreso" onchange="UserCuestEpisodio.update2(this.id)" value="{{ date('Y-m-d', strtotime($ultimo_egreso->egreso))  }}" type="date" class=" text-center form-control bg-light border-0">
                                    <small class="help_egreso"></small>
                                </td>
                                <td class="p-1">
                                    <input id="dia_hos" onchange="UserCuestEpisodio.update2(this.id)" value="{{$ultimo_egreso->dia_hos}}" type="text" class=" text-center form-control bg-light border-0">
                                    <small class="help_dia_hos"></small>
                                </td>
                                <td class="p-1">
                                    <input readonly value="{{ $ubicacion_actual  }}" type="text" class=" text-center form-control bg-light border-0">
                                    <small class="help_"></small>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{-- diagnostico de ingreso --}}
        <div class="row">
            <div class="col-md-12">
                <div class="mt-3">
                    <div class="h5 text-primary">
                        Probabilidad Diagnóstica
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <td style="color:var(--secondary);font-size: 1rem;padding: 0.25rem !important;width:150px;line-height: 2;">
                                    Código por CIE-11
                                </td>
                                <td style="color:var(--secondary);font-size: 1rem;padding: 0.25rem !important;line-height: 2;">
                                    Diagnóstico
                                </td>
                                <td style="width:2em">
                                    <button data-tippy-content="Añadir nuevas filas"
                                    onclick="anadirItem(user_id,user_cuest_episodio_id,'dI')"
                                    class="btn btn-primary"
                                    >
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                    </button>
                                </td>
                            </tr>

                            @foreach ($impDiag as $item)
                                <tr class="row-impDiagn-{{ $item->id }}">
                                    <td rowspan="2" class="p-1">

                                        <input name="diagn_ingre_c" data-dx="impDiagn" onchange="saveImpDiagn({{ $identificador }})" value="{{ $item->cod_cie }}" id="input-code-{{ $identificador }}" readonly style="height: calc(2.25rem + 48px);" type="text" class="form-control bg-light border-0">
                                        <span id="message-{{ $identificador }}"></span>
                                    </td>
                                    <td class="p-1">
                                        <input name="diagn_ingre_v" onchange="saveImpDiagn({{ $identificador }})" value="{{ $item->value }}" id="input-value-{{ $identificador }}" readonly type="text" class="form-control bg-light border-0">
                                    </td>
                                    <td rowspan="2" class="align-middle p-1">

                                        <button data-tippy-content="Eliminar este diagnóstico"
                                        onclick="UserCuestImpresionDiagnostica.destroycie11({{ $item->id }})"
                                        class="delete-row btn btn-light text-primary"
                                        >
                                            <i class="fa fa-minus" aria-hidden="true"></i>
                                        </button>

                                    </td>
                                </tr>
                                <tr class="row-impDiagn-{{ $item->id }}">
                                    <td class="p-1">
                                        <input
                                            autocomplete="off"
                                            class="ctw-input form-control bg-light border-0"
                                            data-imp_diagn_id="{{ $item->id }}"
                                            data-ctw-ino="{{ $identificador }}"
                                            data-tippy-content="Escriba la enfermedad en el clasificador CIE-11, y luego pulse en su código correspondiente."
                                            id="input-title-{{ $identificador }}"
                                            name="diagn_ingre_d"
                                            placeholder="Clasificador CIE-11"
                                            type="search"
                                            onchange="saveImpDiagn({{ $identificador }})"
                                            value="{{ $item->cod_cie_description }}"
                                        >
                                        <div class="ctw-window border-0" data-ctw-ino="{{ $identificador }}"></div>
                                    </td>
                                </tr>
                                @php
                                    if ($identificador < count($impDiag)) {
                                        $identificador = $identificador + 1;
                                    }

                                @endphp
                            @endforeach
                            @php
                                $dI = 1;
                                if(isset($_GET['dI']) && $_GET['dI'] > 0){
                                    $dI = $dI + $_GET['dI'];
                                }
                            @endphp
                            @for ($i =0; $i <= $dI; $i++)
                                <tr class="row-impDiagn-{{ $identificador }}">
                                    <td rowspan="2" class="p-1">
                                        <input name="diagn_ingre_c" data-dx="impDiagn" onchange="saveImpDiagn({{ $identificador }})" value="" id="input-code-{{ $identificador }}" type="text" class="form-control bg-light border-0" style="height: calc(2.25rem + 48px);"  >
                                        <span id="message-{{ $identificador }}"></span>
                                    </td>
                                    <td class="p-1">
                                        <input name="diagn_ingre_v" onchange="saveImpDiagn({{ $identificador }})" value="" id="input-value-{{ $identificador }}" type="text" class="form-control bg-light border-0">
                                    </td>
                                    <td rowspan="2" class="align-middle p-1">
                                        <span id="delete-{{ $identificador }}"></span>
                                    </td>
                                </tr>
                                <tr class="row-impDiagn-{{ $identificador }}">
                                    <td class="p-1">
                                        <input
                                            autocomplete="off"
                                            class="ctw-input imp-diagn form-control bg-light border-0"
                                            data-ctw-ino="{{ $identificador }}"
                                            data-imp_diagn_id="add"
                                            onchange="saveImpDiagn({{ $identificador }})"
                                            data-tippy-content="Escriba la enfermedad en el clasificador CIE-11, y luego pulse en su código correspondiente."
                                            id="input-title-{{ $identificador }}"
                                            name="diagn_ingre_d"
                                            placeholder="Clasificador CIE-11"
                                            type="search"
                                            value=""
                                        >
                                        <div class="ctw-window border-0" data-ctw-ino="{{ $identificador }}"></div>
                                    </td>
                                </tr>
                                @php
                                    $identificador = $identificador + 1;
                                @endphp
                            @endfor
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @php
            $diagn_ingre_total = $identificador;
        @endphp
        {{-- comorbilidades --}}
        <div class="row">
            <div class="col-md-12">
                <div class="mt-3">
                    <div class="h5 text-primary">
                        Comorbilidades
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered">

                            <thead>
                                <tr>
                                    <td style="color:var(--secondary);font-size: 1rem;padding: 0.25rem !important;width:150px;line-height: 2;">
                                        Código por CIE-11
                                    </td>
                                    <td  style="color:var(--secondary);font-size: 1rem;padding: 0.25rem !important;line-height: 2;">
                                        Comorbilidad
                                    </td>
                                    <td style="width:2em">
                                        <button data-tippy-content="Añadir nuevas filas"
                                        onclick="anadirItem(user_id,user_cuest_episodio_id,'tC')"
                                        class="btn btn-primary"
                                        >
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                        </button>
                                    </td>
                                </tr>
                            </thead>

                            </tbody>

                                @if (count($comorbilidad) > 0)

                                    @foreach ($comorbilidad as $key => $item)
                                        <tr class="row-comorb-{{ $item->id }}">
                                            <td rowspan="2" class="p-1">
                                                <input readonly data-dx="comor" name="comor_c"  value="{{ $item->cod_cie }}"  style="height: calc(2.25rem + 48px);"  id="input-code-{{ $identificador }}" type="text" class="form-control bg-light border-0">
                                                <span id="message-{{ $identificador }}"></span>
                                            </td>
                                            <td class="p-1">
                                                <input readonly type="text" name="comor_v" id="input-value-{{ $identificador }}" value="{{ $item->description }}" class="form-control bg-light border-0">
                                            </td>
                                            <td rowspan="2" class="align-middle p-1">
                                                <button data-tippy-content="Eliminar comorbilidad"
                                                onclick="UserCuestComorbilidad.destroycie11({{ $item->id }})"
                                                class="delete-row btn btn-light text-primary"
                                                >
                                                    <i class="fa fa-minus" aria-hidden="true"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr class="row-comorb-{{ $item->id }}">
                                            <td class="p-1">
                                                <input

                                                autocomplete="off"
                                                class="ctw-input form-control bg-light border-0"
                                                data-ctw-ino="{{ $identificador }}"
                                                data-comor_id="{{ $item->id }}"
                                                data-tippy-content="Escriba la enfermedad en el clasificador CIE-11, y luego pulse en su código correspondiente."
                                                id="input-title-{{ $identificador }}"
                                                name="comor_d"
                                                placeholder="Clasificador CIE-11"
                                                type="search"
                                                value="{{ $item->cod_cie_description }}"
                                            >
                                                <div class="ctw-window border-0" data-ctw-ino="{{ $identificador }}"></div>
                                            </td>
                                        </tr>
                                        @php
                                            $i=$i+1;
                                            if ($key < count($comorbilidad)) {
                                                $identificador = $identificador + 1;
                                            }
                                        @endphp

                                    @endforeach
                                @endif
                                @php
                                    $tC = 1;
                                    if(isset($_GET['tC']) && $_GET['tC'] > 0){
                                        $tC = $tC + $_GET['tC'];
                                    }
                                @endphp
                                @for ($i =0; $i <= $tC; $i++)
                                    <tr class="row-comorb-{{ $identificador }}">
                                        <td rowspan="2" class="p-1">
                                            <input name="comor_c" data-dx="comor" value="" id="input-code-{{ $identificador }}" type="text" class="form-control bg-light border-0" style="height: calc(2.25rem + 48px);"  >
                                            <span id="message-{{ $identificador }}"></span>
                                        </td>
                                        <td class="p-1">
                                            <input name="comor_v" value="" id="input-value-{{ $identificador }}" type="text" class="form-control bg-light border-0">
                                        </td>
                                        <td rowspan="2" class="align-middle p-1">

                                            <span id="delete-{{ $identificador }}"></span>

                                        </td>
                                    </tr>
                                    <tr class="row-comorb-{{ $identificador }}">
                                        <td class="p-1">
                                            <input
                                                autocomplete="off"
                                                class="ctw-input imp-diagn form-control bg-light border-0"
                                                data-ctw-ino="{{ $identificador }}"
                                                data-comor_id="add"
                                                data-tippy-content="Escriba la enfermedad en el clasificador CIE-11, y luego pulse en su código correspondiente."
                                                id="input-title-{{ $identificador }}"
                                                name="comor_d"
                                                placeholder="Clasificador CIE-11"
                                                type="search"
                                                value=""
                                            >
                                            <div class="ctw-window border-0" data-ctw-ino="{{ $identificador }}"></div>
                                        </td>
                                    </tr>
                                    @php
                                        $identificador = $identificador + 1;
                                    @endphp
                                @endfor
                            </tbody>
                        </table>


                    </div>


                </div>
            </div>
        </div>
        @php
            $comor_total = $identificador;
        @endphp
        {{-- uti --}}
        <div class="row">
            <div class="col-md-12">
                <div class="mt-3">
                    <div class="h5 text-primary">
                        UTI
                    </div>

                    <select onchange="$('#uti_causa').toggle('slow'); saveUti()" name="uti" id="uti" class="form-control bg-light border-0 mb-1" required="required">
                        <option {{ $ultimo_egreso->uti==1?'selected':'' }} value="1">No</option>
                        <option {{ $ultimo_egreso->uti==2?'selected':'' }} value="2">Si</option>
                    </select>

                    <div  class="form-group">
                        <select onchange="saveUti()" style="{{ $ultimo_egreso->uti_causa==0 || is_null($ultimo_egreso->uti_causa)?'display:none':'diplay:block' }}" class="form-control bg-light border-0" name="uti_causa" id="uti_causa">
                            <option {{ $ultimo_egreso->uti_causa==0?'selected':'' }} value="0">Seleccione causa</option>
                            <option {{ $ultimo_egreso->uti_causa==1?'selected':'' }} value="1">Complicación</option>
                            <option {{ $ultimo_egreso->uti_causa==2?'selected':'' }} value="2">Protocolo</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        {{-- egreso --}}

        <div class="row">
            <div class="col-md-12">
                <div class="mt-3">
                    <div class="h5 text-primary">
                        Diagnóstico de Egreso
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <td style="color:var(--secondary);font-size: 1rem;padding: 0.25rem !important;width:150px;line-height: 2;">
                                    Código por CIE-11
                                </td>
                                <td style="color:var(--secondary);font-size: 1rem;padding: 0.25rem !important;line-height: 2;">
                                    Diagnóstico
                                </td>
                                <td style="width:2em">
                                    <button data-tippy-content="Añadir nuevas filas"
                                    onclick="anadirItem(user_id,user_cuest_episodio_id,'dE')"
                                    class="btn btn-primary"
                                    >
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                    </button>
                                </td>
                            </tr>
                            @php

                            @endphp
                            @foreach ($diagn_egre as $key => $item)
                                <tr class="row-egreso-{{ $item->id }}">
                                    <td rowspan="2" class="p-1">

                                        <input name="diagn_egre_c" data-dx="egreso" value="{{ $item->cod_cie }}" id="input-code-{{ $identificador }}" readonly style="height: calc(2.25rem + 48px);" type="text" class="form-control bg-light border-0">
                                        <span id="message-{{ $identificador }}"></span>
                                    </td>
                                    <td class="p-1">
                                        <input name="diagn_egre_v" onchange="saveEgreso({{ $identificador }})" value="{{ $item->coment }}" id="input-value-{{ $identificador }}" readonly type="text" class="form-control bg-light border-0">
                                    </td>
                                    <td rowspan="2" class="align-middle p-1">

                                        <button data-tippy-content="Eliminar este diagnóstico"
                                        onclick="UserCuestEgreso.destroycie11({{ $item->id }})"
                                        class="delete-row btn btn-light text-primary"
                                        >
                                            <i class="fa fa-minus" aria-hidden="true"></i>
                                        </button>

                                    </td>
                                </tr>
                                <tr class="row-egreso-{{ $item->id }}">
                                    <td class="p-1">
                                        <input
                                            autocomplete="off"
                                            onchange="saveEgreso({{ $identificador }})"
                                            class="ctw-input form-control bg-light border-0"
                                            data-diagn_egre_id="{{ $item->id }}"
                                            data-ctw-ino="{{ $identificador }}"
                                            data-tippy-content="Escriba la enfermedad en el clasificador CIE-11, y luego pulse en su código correspondiente."
                                            id="input-title-{{ $identificador }}"
                                            name="diagn_egre_d"
                                            placeholder="Clasificador CIE-11"
                                            type="search"
                                            value="{{ $item->cod_cie_description }}"
                                        >
                                        <div class="ctw-window border-0" data-ctw-ino="{{ $identificador }}"></div>
                                    </td>
                                </tr>
                                @php
                                    $i=$i+1;
                                    if ($key < count($diagn_egre)) {
                                        $identificador = $identificador + 1;
                                    }
                                @endphp
                            @endforeach
                            @php
                                $dE = 1;
                                if(isset($_GET['dE']) && $_GET['dE'] > 0){
                                    $dE = $dE + $_GET['dE'];
                                }
                            @endphp
                            @for ($i =0; $i <= $dE; $i++)
                                <tr class="row-egreso-{{ $identificador }}">
                                    <td rowspan="2" class="p-1">

                                        <input name="diagn_egre_c" data-dx="egreso" value="" id="input-code-{{ $identificador }}" type="text" class="form-control bg-light border-0" style="height: calc(2.25rem + 48px);"  >
                                        <span id="message-{{ $identificador }}"></span>
                                    </td>
                                    <td class="p-1">
                                        <input name="diagn_egre_v" onchange="saveEgreso({{ $identificador }})" value="" id="input-value-{{ $identificador }}" type="text" class="form-control bg-light border-0">
                                    </td>
                                    <td rowspan="2" class="align-middle p-1">

                                        <span id="delete-{{ $identificador }}"></span>

                                    </td>
                                </tr>
                                <tr class="row-egreso-{{ $identificador }}">
                                    <td class="p-1">
                                        <input
                                            autocomplete="off"
                                            class="ctw-input form-control bg-light border-0"
                                            data-ctw-ino="{{ $identificador }}"
                                            data-diagn_egre_id="add"
                                            onchange="saveEgreso({{ $identificador }})"
                                            data-tippy-content="Escriba la enfermedad en el clasificador CIE-11, y luego pulse en su código correspondiente."
                                            id="input-title-{{ $identificador }}"
                                            name="diagn_egre_d"
                                            placeholder="Clasificador CIE-11"
                                            type="search"
                                            value=""
                                        >
                                        <div class="ctw-window border-0" data-ctw-ino="{{ $identificador }}"></div>
                                    </td>

                                </tr>
                                @php
                                    $identificador = $identificador + 1;
                                @endphp
                            @endfor
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @php
            $diagn_egre_total = $identificador;
        @endphp
        <!-- destino -->
        <div class="row">
            <div class="col-md-12">
                <div class="mt-3">

                    <div class="h5 text-primary">
                        Destino Alta
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">

                            <tr>
                                <td class="p-1">
                                    <div class="bg-light rounded">
                                        {{ $ubicacion_destino }}
                                    </div>
                                </td>

                            </tr>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <button id="user_cuest_model_store" class="font-weight-bold btn btn-success mb-1 btn-block btn-lg">Guardar</button>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <button onclick="close_window()"  id="regresar" class="font-weight-bold btn btn-primary mb-1 btn-block btn-lg">Regresar</button>
            </div>
        </div>
        <br><br>



    </div>

    <script src="https://icdcdn.who.int/embeddedct/icd11ect-1.4.js"></script>
    <script>
        const mySettings = {
            language: "es",
            apiServerUrl: "https://icd11restapi-developer-test.azurewebsites.net",
            height: "30vh"
        };

        // example of an Embedded Coding Tool using the callback selectedEntityFunction for copying the code selected in an html element
        const myCallbacks = {
        selectedEntityFunction: selectedEntity => {
            //alert('input-code-'+selectedEntity.iNo + " " +'input-title-'+selectedEntity.iNo)
            ECT.Handler.clear(selectedEntity.iNo)
                document.getElementById('input-code-'+selectedEntity.iNo).value = selectedEntity.code;
                document.getElementById('input-title-'+selectedEntity.iNo).value = selectedEntity.title;
                let dx = $('#input-code-'+selectedEntity.iNo).data('dx')
                switch (dx) {
                    case 'impDiagn':saveImpDiagn(selectedEntity.iNo); break;
                    case 'comor':saveComorbilidad(selectedEntity.iNo); break;
                    case 'egreso': saveEgreso(selectedEntity.iNo); break;
                }



        }
        };
        // configure all the Embedded Coding Tool
        ECT.Handler.configure(mySettings, myCallbacks);
    </script>

@endsection
@section('footer')
    @include('component.menu_footer')
@endsection
@section('script')
<script>
    let user_id = "{{ $user_id }}"
    let user_cuest_episodio_id = parseInt("{{ $user_cuest_episodio_id }}");
    let diagn_ingre_total = parseInt("{{ $diagn_ingre_total }}");
    let comor_total = parseInt("{{ $comor_total }}");
    let diagn_egre_total = parseInt("{{ $diagn_egre_total }}");
    function anadirItem(user_id,episodio_id,tipo) {
        Swal.fire({
            title: 'Escribe el número de filas',
            input: 'number',
            inputAttributes: {
                autocapitalize: 'off'
            },
            showCancelButton: true,
            confirmButtonText: 'Agregar',
            showLoaderOnConfirm: true,
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.isConfirmed) {
                console.log(result.value)
                location.href = `/clasificador_cie11/${user_id}/${episodio_id}?${tipo}=${result.value}`

            }
        })

    }
    function saveImpDiagn(n){

        if(
            $(`#input-value-${n}`).val() !=="" &&
            $(`#input-title-${n}`).val() !=="" &&
            $(`#input-code-${n}`).val() !==""
        ){
            UserCuestImpresionDiagnostica.update({
                user_id,
                value:$(`#input-value-${n}`).val(),
                user_cuest_episodio_id,
                user_cuest_imp_diagn_id:$("#input-title-"+n).data('imp_diagn_id'),
                cod_cie:$(`#input-code-${n}`).val(),
                cod_cie_description:$(`#input-title-${n}`).val()
            })
            .then(response=>{
                $(`#message-${n}`).html(`
                        <div class="text-center text-success" style="background-color: var(--light)">
                            <i class="fas fa-check-square"></i>
                        </div>
                    `);

                if ($("#input-title-"+n).data('imp_diagn_id')==="add") {
                    $(`#delete-${n}`).html(`
                        <div>
                            <button
                                data-tippy-content="Eliminar diagnóstico"
                                onclick="UserCuestImpresionDiagnostica.destroycie11(${response.id},${n})"
                                class="tooltip-primary delete-row btn btn-light text-primary"
                            >
                                <i class="fa fa-minus" aria-hidden="true"></i>
                            </button>
                        </div>
                    `);
                    activarTooltip()
                }

            })
        }
    }
    function saveComorbilidad(n){

        if(
            $(`#input-value-${n}`).val() !=="" &&
            $(`#input-title-${n}`).val() !=="" &&
            $(`#input-code-${n}`).val() !==""
        ){
            UserCuestComorbilidad.update({
                user_id,
                description:$(`#input-value-${n}`).val(),
                user_cuest_comorbilidad_id:$("#input-title-"+n).data('comor_id'),
                cod_cie:$(`#input-code-${n}`).val(),
                cod_cie_description:$(`#input-title-${n}`).val()
            })
            .then(response=>{
                $(`#message-${n}`).html(`
                        <div class="text-center text-success" style="background-color: var(--light)">
                            <i class="fas fa-check-square"></i>
                        </div>
                    `);

                if ($("#input-title-"+n).data('comor_id')==="add") {
                    $(`#delete-${n}`).html(`
                        <div>
                            <button
                                data-tippy-content="Eliminar diagnóstico"
                                onclick="UserCuestComorbilidad.destroycie11(${response.id},${n})"
                                class="tooltip-primary delete-row btn btn-light text-primary"
                            >
                                <i class="fa fa-minus" aria-hidden="true"></i>
                            </button>
                        </div>
                    `);
                    activarTooltip()
                }

            })
        }
    }
    function saveEgreso(n){

        if(
            $(`#input-value-${n}`).val() !=="" &&
            $(`#input-title-${n}`).val() !=="" &&
            $(`#input-code-${n}`).val() !==""
        ){

            UserCuestEgreso.update({
                user_id,
                user_cuest_episodio_id,
                coment: $(`#input-value-${n}`).val(),
                user_cuest_egreso_id:$("#input-title-"+n).data('diagn_egre_id'),
                cod_cie:$(`#input-code-${n}`).val(),
                cod_cie_description:$(`#input-title-${n}`).val()
            })
            .then(response=>{
                $(`#message-${n}`).html(`
                        <div class="text-center text-success" style="background-color: var(--light)">
                            <i class="fas fa-check-square"></i>
                        </div>
                    `);

                if ($("#input-title-"+n).data('diagn_egre_id')==="add") {
                    $(`#delete-${n}`).html(`
                        <div>
                            <button
                                data-tippy-content="Eliminar diagnóstico"
                                onclick="UserCuestEgreso.destroycie11(${response.id},${n})"
                                class="tooltip-primary delete-row btn btn-light text-primary"
                            >
                                <i class="fa fa-minus" aria-hidden="true"></i>
                            </button>
                        </div>
                    `);
                    activarTooltip()
                }
            })
        }
    }
    function saveUti(){

        UserCuestEpisodio.update({user_id})
    }
    $(function () {
        saveUti()
    });



    $("#user_cuest_model_store").on("click", function () {//input-title-1
        loading("#clasificador")
        if (window.opener !== null) {
            window.opener.actualizarModalcie11()
        }
        message = Component.alertMessage("update_success");
        Toast.fire({
            icon: message['image'],
            title: message['title'],
            text: message['message'],
            didClose: () => {
                setTimeout(() => { close();}, 110);
            }
        })

    });


</script>
<script>
    $(".ctw-input").on("change", function () {
        $(this).data("id", this.value);
    });
</script>
@endsection
@section('css')
    <style>

    </style>
@endsection
