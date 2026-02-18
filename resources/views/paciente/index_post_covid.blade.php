@extends('component.template')

@section('title')
    CMDLT | PatientCare
@endsection
@section('header')
      @include('component.menu_principal_v2')
@endsection

@section('content')
    <header>

    </header>
    <main class=" overflow-auto p-1" style="height:91vh;padding-bottom: 10vh !important;">
        <div class="h2 d-flex justify-content-between">
            <div>
                <b class="text-primary">Clínica Post-covid</b> | <span class="text-gray">Sala de espera</span>
            </div>
            <div>
                <button onclick="window.location='/paciente/post_covid_create'" class="btn btn-success btn-block">Nuevo Paciente</button>
            </div>

        </div>
        <table id="example" class="table table-bordered table-striped bg-white" >
            <thead>
                <tr>

                    <th class="w-50">Paciente</th>
                    <th style="width:10%">Prioridad</th>

                    <th style="width:30%">Cuestionario</th>

                    <th style="width:10%">Acciones</th>
                </tr>
            </thead>
            <tbody id="filasPacientes">
                <tr>
                    <td colspan="11">
                        <div class="d-flex m-4 justify-content-center text-primary">
                            Cargando...
                            <div class="spinner-border" role="status">
                                <span class="sr-only"></span>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>

        </table>
    </main>
    <footer>

    </footer>
@endsection
@section('footer')

@endsection
@section('script')
<script>
    document.addEventListener("DOMContentLoaded", async function(){
        let model = await UserPostCovid.getAll()
        let $fragment = document.createDocumentFragment();
        let $tbody = document.getElementById('filasPacientes')
        if (model.length > 0) {
            model.forEach(x=>{
                let $tr = document.createElement('tr')
                let $td1 = document.createElement('td')
                    $td1.innerHTML= `
                        <div class='container-fluid border rounded'>
                            <div class='d-flex flex-row  p-1' style='height:100%'>
                            <div class='p-1 flex-fill align-self-start flex-grow-1 border-right'>
                                <div class='d-flex flex-row justify-content-center p-1 border-bottom'>
                                    <div class="d-flex" style="align-items: center;">
                                        <div class="mx-1 mb-1">
                                            <img onerror="this.src='/image/system/icono-paciente-blanco.svg';" src="${x.imagen}"
                                                style="width:1.5cm;height:1.5cm" data-tippy-content="Imagen del paciente"
                                                class="tooltip-primary border border-primary rounded-circle mx-auto d-block" alt="...">
                                        </div>
                                        <div>
                                            <div>
                                                <h4 data-tippy-content="Nombre del paciente" class="tooltip-primary text-primary"
                                                    style="margin-bottom: 0;">
                                                    ${x.paciente}
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class='d-flex justify-content-center p-1'>
                                    <div class='d-flex p-1 flex-fill  align-self-start'>
                                        <div class='d-flex  flex-column flex-fill align-items-center p-1'>
                                            <div class='d-flex p-1 flex-fill justify-content-center'>
                                                <b class="text-primary" style="font-size:0.8em;">Cédula</b>
                                            </div>
                                            <div class='d-flex p-1 flex-fill justify-content-center'>
                                                <div class="text-gray text-nowrap overflow-hidden">
                                                    ${x.cedula}
                                                </div>
                                            </div>
                                        </div>
                                        <div class='d-flex flex-column  flex-fill align-items-center p-1 border-left border-right'>
                                            <div class='d-flex p-1 flex-fill justify-content-center'>
                                                <b class="text-primary" style="font-size:0.8em;">Edad</b>
                                            </div>
                                            <div class='d-flex p-1 flex-fill justify-content-center'>
                                                <div class="text-gray">
                                                    ${x.edad}
                                                </div>
                                            </div>
                                        </div>
                                        <div class='d-flex flex-column flex-fill align-items-center p-1'>
                                            <div class='d-flex p-1 flex-fill justify-content-center'>
                                                <b class="text-primary" style="font-size:0.8em;">Sexo</b>
                                            </div>
                                            <div class='d-flex p-1 flex-fill justify-content-center'>
                                                <div class="text-gray">
                                                    ${x.genero.toUpperCase()}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='p-1 flex-fill align-self-start'>
                                <div class='d-flex flex-column align-items-center p-1'>
                                    <div class='d-flex p-1 flex-fill justify-content-center'>
                                        <b class="text-primary" style="font-size:0.9em;">Fecha ingreso</b>
                                    </div>
                                    <div class='d-flex p-1 flex-fill justify-content-center'>
                                        <div class="text-gray text-nowrap overflow-hidden">
                                            ${x.registro}
                                        </div>
                                    </div>
                                </div>
                                <div class='d-flex flex-column align-items-center p-1'>
                                    <div class='d-flex p-1 flex-fill justify-content-center'>
                                        <b class="text-primary" style="font-size:0.9em;">Teléfono Contacto</b>
                                    </div>
                                    <div class='d-flex p-1 flex-fill justify-content-center'>
                                        <button
                                            class="btn btn-outline-primary text-nowrap btn-sm tooltip-primary"
                                            data-tippy-content="Teléfono contacto del paciente: ${x.telefono_movil}"
                                            onclick="window.open('https://api.whatsapp.com/send?phone=${x.telefono_movil}')">
                                            <i class="fab fa-whatsapp text-success"></i> ${x.telefono_movil}
                                        </button>

                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    `;
                    $tr.appendChild($td1)


                let $td2 = document.createElement('td')
                    $td2.classList.add(`text-${x.prioridad_color}`)
                    $td2.textContent=x.prioridad
                    $tr.appendChild($td2)

                let $td3 = document.createElement('td')
                    $td3.innerHTML=`
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Hospitalización: ${x.hospitalizacion === "Si" ? "<i class='fas fa-check text-success'></i>": "<i class='fas fa-ban text-danger'></i>"}</li>
                            <li class="list-group-item">Atención médica: ${x.atencion_med === "Si" ? "<i class='fas fa-check text-success'></i>": "<i class='fas fa-ban text-danger'></i>"}</li>
                            <li class="list-group-item">Oxigenoterapia: ${x.oxigenoterapia === "Si" ? "<i class='fas fa-check text-success'></i>": "<i class='fas fa-ban text-danger'></i>"}</li>
                            <li class="list-group-item">Sintomatología: ${x.sintomatologia === "Si" ? "<i class='fas fa-check text-success'></i>": "<i class='fas fa-ban text-danger'></i>"}</li>

                        </ul>
                    `;
                    $tr.appendChild($td3)

                    let $td4 = document.createElement('td')

                    $tr.appendChild($td4)

                    $fragment.appendChild($tr)

            })
        }else{
            let $tr =   document.createElement('tr')
            let $td =   document.createElement('td')
                $td.setAttribute('colspan', 4);
                $td.classList.add("text-center","text-primary")
                $td.textContent = "No se encontraron nuevos pacientes";
            $tr.appendChild($td)
                        $fragment.appendChild($tr)
        }

        $tbody.innerHTML=""
        $tbody.appendChild($fragment)

    })


</script>
@endsection
@section('css')

@endsection
