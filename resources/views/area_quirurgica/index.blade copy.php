@extends('component.template')

@section('title')
    PatientCare | Plan Quirúrgico
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
    <div class="container-fluid">
        <div class="row pt-2">
            <div class="col-12 col-sm-4 col-md-3 col-lg-2">
                <div class="nav mx-1 flex-row text-center text-sm-left flex-sm-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link flex-fill active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">
                        Solicitudes Qx
                    </a>
                    <a class="nav-link flex-fill" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                        Crear solicitud Qx
                    </a>
                    <a class="nav-link flex-fill" id="v-pills-profile2-tab" data-toggle="pill" href="#v-pills-profile2" role="tab" aria-controls="v-pills-profile2" aria-selected="false">
                        Personal del area
                    </a>
                </div>
            </div>
            <div class="col-12 col-sm-8 col-md-9 col-lg-10">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <div class="d-flex flex-column pt-2" style="height:85vh">
                            <h3 class="text-primary">
                                Cupos regístrados
                            </h3>
                            <div class="flex-fill overflow-auto">
                                <table id="tableSolicitudes" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="sticky-top bg-gray" style="color: var(--primary) !important;">Qx</th>
                                            <th class="sticky-top bg-gray" style="color: var(--primary) !important;">Fecha</th>
                                            <th class="sticky-top bg-gray" style="color: var(--primary) !important;">Hora</th>
                                            <th class="sticky-top bg-gray" style="color: var(--primary) !important;">Paciente</th>
                                            <th class="sticky-top bg-gray" style="color: var(--primary) !important;">Intervención</th>
                                            <th class="sticky-top bg-gray" style="color: var(--primary) !important;">Cirujano Principal</th>
                                            <th class="sticky-top bg-gray" style="color: var(--primary) !important;">Anestesiologo</th>
                                            <th class="sticky-top bg-gray" style="color: var(--primary) !important;">Personal Asistencial</th>
                                            <th class="sticky-top bg-gray" style="color: var(--primary) !important;">Destino</th>
                                            <th class="sticky-top bg-gray" style="color: var(--primary) !important;">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>



                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                        <div class="d-flex flex-column pt-2" style="height:85vh">
                            <h3 class="text-primary">
                                Nueva Solicitud de Quirófano
                            </h3>
                            <div class="flex-fill overflow-auto">
                               aqui va un formulario
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-profile2" role="tabpanel" aria-labelledby="v-pills-profile2-tab">
                        <div class="d-flex flex-column pt-2" style="height:85vh">
                            <h3 class="text-primary">
                                Personal de area
                            </h3>
                            Pre/anestesia<br>
                            Recuperación<br>
                            Pre y Post Obstetrico / Pediátrico <br>
                            <div class="flex-fill overflow-auto">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="sticky-top bg-gray" style="color: var(--primary) !important;">Qx</th>
                                            <th class="sticky-top bg-gray" style="color: var(--primary) !important;">Hora</th>
                                            <th class="sticky-top bg-gray" style="color: var(--primary) !important;">Paciente</th>
                                            <th class="sticky-top bg-gray" style="color: var(--primary) !important;">Intervención</th>
                                            <th class="sticky-top bg-gray" style="color: var(--primary) !important;">Cirujano Principal</th>
                                            <th class="sticky-top bg-gray" style="color: var(--primary) !important;">Anestesiologo</th>
                                            <th class="sticky-top bg-gray" style="color: var(--primary) !important;">Personal Asistencial</th>
                                            <th class="sticky-top bg-gray" style="color: var(--primary) !important;">Destino</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Qx</td>
                                            <td>Hora</td>
                                            <td>Paciente</td>
                                            <td>Intervención</td>
                                            <td>Cirujano Principal</td>
                                            <td>Anestesiologo</td>
                                            <td>Personal Asistencial</td>
                                            <td>Destino</td>
                                        </tr>
                                        <tr>
                                            <td>Qx</td>
                                            <td>Hora</td>
                                            <td>Paciente</td>
                                            <td>Intervención</td>
                                            <td>Cirujano Principal</td>
                                            <td>Anestesiologo</td>
                                            <td>Personal Asistencial</td>
                                            <td>Destino</td>
                                        </tr>
                                        <tr>
                                            <td>Qx</td>
                                            <td>Hora</td>
                                            <td>Paciente</td>
                                            <td>Intervención</td>
                                            <td>Cirujano Principal</td>
                                            <td>Anestesiologo</td>
                                            <td>Personal Asistencial</td>
                                            <td>Destino</td>
                                        </tr>
                                        <tr>
                                            <td>Qx</td>
                                            <td>Hora</td>
                                            <td>Paciente</td>
                                            <td>Intervención</td>
                                            <td>Cirujano Principal</td>
                                            <td>Anestesiologo</td>
                                            <td>Personal Asistencial</td>
                                            <td>Destino</td>
                                        </tr>
                                        <tr>
                                            <td>Qx</td>
                                            <td>Hora</td>
                                            <td>Paciente</td>
                                            <td>Intervención</td>
                                            <td>Cirujano Principal</td>
                                            <td>Anestesiologo</td>
                                            <td>Personal Asistencial</td>
                                            <td>Destino</td>
                                        </tr>
                                        <tr>
                                            <td>Qx</td>
                                            <td>Hora</td>
                                            <td>Paciente</td>
                                            <td>Intervención</td>
                                            <td>Cirujano Principal</td>
                                            <td>Anestesiologo</td>
                                            <td>Personal Asistencial</td>
                                            <td>Destino</td>
                                        </tr>
                                        <tr>
                                            <td>Qx</td>
                                            <td>Hora</td>
                                            <td>Paciente</td>
                                            <td>Intervención</td>
                                            <td>Cirujano Principal</td>
                                            <td>Anestesiologo</td>
                                            <td>Personal Asistencial</td>
                                            <td>Destino</td>
                                        </tr>
                                        <tr>
                                            <td>Qx</td>
                                            <td>Hora</td>
                                            <td>Paciente</td>
                                            <td>Intervención</td>
                                            <td>Cirujano Principal</td>
                                            <td>Anestesiologo</td>
                                            <td>Personal Asistencial</td>
                                            <td>Destino</td>
                                        </tr>
                                        <tr>
                                            <td>Qx</td>
                                            <td>Hora</td>
                                            <td>Paciente</td>
                                            <td>Intervención</td>
                                            <td>Cirujano Principal</td>
                                            <td>Anestesiologo</td>
                                            <td>Personal Asistencial</td>
                                            <td>Destino</td>
                                        </tr>
                                        <tr>
                                            <td>Qx</td>
                                            <td>Hora</td>
                                            <td>Paciente</td>
                                            <td>Intervención</td>
                                            <td>Cirujano Principal</td>
                                            <td>Anestesiologo</td>
                                            <td>Personal Asistencial</td>
                                            <td>Destino</td>
                                        </tr>
                                        <tr>
                                            <td>Qx</td>
                                            <td>Hora</td>
                                            <td>Paciente</td>
                                            <td>Intervención</td>
                                            <td>Cirujano Principal</td>
                                            <td>Anestesiologo</td>
                                            <td>Personal Asistencial</td>
                                            <td>Destino</td>
                                        </tr>
                                        <tr>
                                            <td>Qx</td>
                                            <td>Hora</td>
                                            <td>Paciente</td>
                                            <td>Intervención</td>
                                            <td>Cirujano Principal</td>
                                            <td>Anestesiologo</td>
                                            <td>Personal Asistencial</td>
                                            <td>Destino</td>
                                        </tr>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
@endsection
@section('script')
<script>
    let useState = {
        data:[]
    }
    let d = document
    let selectorTableSolicitudes = d.querySelector("#tableSolicitudes tbody")
    console.log(selectorTableSolicitudes)
    let renderRowSolicitudesQuirofano = (row,key) =>{
       return `
        <tr class="${row['active'] ? 'bg-gray':''}" data-key="${key}" id="row_${row['id']}">
            <td>
                ${row['n_quirofano']}
            </td>
            <td class="text-nowrap">
                ${row['fecha_solicitud']}
            </td>
            <td class="text-nowrap">
                ${row['hora_inicio']}
            </td>
            <td>
                ${row['paciente']}
            </td>
            <td>
                <div class="d-flex flex-column">
                    <div>
                        ${intervencion(row)}
                    </div>
                    <div>
                        ${equipos_especiales(row)}
                    </div>
                    <div>
                        ${tipo_intervencion(row)}
                    </div>
                </div>
            </td>
            <td>
                ${cirujano_principal(row)}
            </td>
            <td>
                ${anestesiologo(row)}
            </td>
            <td>
                <ul style="padding:0" class="mt-2 mb-0">

                    <li class="d-flex mb-1 align-items-center mr-1 text-nowrap">
                        <div class="rounded-left bg-primary" style="padding:0.4rem;font-size:0.5rem;width:20px;">
                            CA
                        </div>
                        <select class="border-0 rounded-right">
                            <option>Opcion 1</option>
                            <option>Opcion 2</option>
                            <option>Opcion 3</option>
                        </select>
                    </li>
                    <li class="d-flex mb-1 align-items-center mr-1 text-nowrap">
                        <div class="rounded-left bg-success" style="padding:0.4rem;font-size:0.5rem;width:20px;">
                            CC
                        </div>
                        <select class="border-0 rounded-right">
                            <option>Opcion 1</option>
                            <option>Opcion 2</option>
                            <option>Opcion 3</option>
                        </select>
                    </li>
                    <li class="d-flex mb-1 align-items-center mr-1 text-nowrap">
                        <div class="rounded-left  bg-secondary" style="padding:0.4rem;font-size:0.5rem;width:20px;">
                            I
                        </div>
                        <select class="border-0 rounded-right">
                            <option>Opcion 1</option>
                            <option>Opcion 2</option>
                            <option>Opcion 3</option>
                        </select>
                    </li>

                </ul>
            </td>
            <td>
                ${row['destino']}
            </td>
            <td class="text-nowrap">
                <button class="btn btn-default btn-sm"><i class="fas fa-edit text-info"></i></button>
                <button class="btn d-none btn-default btn-sm"><i class="fas fa-eye text-info"></i></button>
                <button data-key="${key}" data-id="${row['id']}" onclick="btnMostrarOcultarSolicitud(this)" class="btnMostrarOcultarSolicitud btn btn-default btn-sm">
                    <i class="fas ${row['active'] ? 'fa-eye':'fa-eye-slash'} text-info"></i>
                </button>
            </td>
        </tr>
       `

    }
    let btnMostrarOcultarSolicitud  =  async (btn)=>{
        console.log(btn.dataset)

        let {key,id} = btn.dataset
        useState['data'][key]['active']= 0
        //let result = get(`/areaquirurgica/cupo/show/${}/`)
        console.log(btn.querySelector("i"))
        if(btn.querySelector("i").classList.contains("fa-eye-slash")){
            d.querySelector(`#row_${id}`).classList.add("bg-gray")
            btn.querySelector("i").classList.remove("fa-eye-slash")
            btn.querySelector("i").classList.add("fa-eye")
        }else{
            d.querySelector(`#row_${id}`).classList.remove("bg-gray")

            btn.querySelector("i").classList.remove("fa-eye")
            btn.querySelector("i").classList.add("fa-eye-slash")
        }
        //alert("aaaaaaaaaaaaaaaaa")
    }
    let tipo_intervencion =  (row)=>{

        let temp_row = `

                <span class="badge badge-danger text-left text-white" >
                    EM
                </span>
                <span class="badge badge-warning text-left text-dark" >
                    EL
                </span>
            `
        return temp_row

    }
    let equipos_especiales =  (row)=>{
        let temp_row = ``
        if(JSON.parse(row['equipos_especiales']).length > 0){
            temp_row = `

                    <span class="badge text-left text-dark" style="background-color: #8ad3f7;">
                        <b >Equipos Especiales:</b>
                        <ul class="mt-2 mb-0">
                `
                JSON.parse(row['equipos_especiales']).forEach(x=>{
                    temp_row += `
                        <li>
                        ${x.description}
                        </li>
                    `
                })
            temp_row += `
                        </ul>
                    </span><br>
                `
        }


        return temp_row

    }
    let anestesiologo =  (row)=>{
        let temp_row = "<ul style='padding:10px'>"
            JSON.parse(row['anestesiologo']).forEach(x=>{
                temp_row += `
                    <li>
                       ${x.description}
                    </li>
                `
            })
        temp_row += "</ul>"
        return temp_row

    }
    let cirujano_principal =  (row)=>{
        let temp_row = "<ul style='padding:10px'>"
            JSON.parse(row['cirujano_principal']).forEach(x=>{
                temp_row += `
                    <li>
                       ${x.description}
                    </li>
                `
            })
        temp_row += "</ul>"
        return temp_row

    }
    let intervencion =  (row)=>{
        let temp_row = "<ul style='padding:10px' class='mb-0'>"
            JSON.parse(row['intervencion']).forEach(x=>{
                temp_row += `
                    <li>
                       ${x.description}
                    </li>
                `
            })
        temp_row += "</ul>"
        return temp_row

    }
    let getSolicitudesQuirofano = async ()=>{
        return await get("/areaquirurgica/cupo/getAll");

    }

    document.addEventListener("DOMContentLoaded", async ()=>{
        useState['data'] =  await getSolicitudesQuirofano()

        /****/
        console.log(useState['data'].length)
        if( useState['data'].length > 0){
            selectorTableSolicitudes.innerHTML = null
            useState['data'].forEach( (row,key)=>{
                selectorTableSolicitudes.insertAdjacentHTML("beforeend",renderRowSolicitudesQuirofano(row,key))
            })
        } else{
            selectorTableSolicitudes.innerHTML = `
                <tr>
                    <td colspan="8" class="text-center">
                        No se encontraron Solicitudes
                    </td>
                </tr>
            `
        }

        /****/
        console.log( useState['data'] )
    })
</script>
@endsection
@section('css')

<style>
    .sticky-top {
        position: -webkit-sticky;
        position: sticky;
        top: -1px;
        z-index: 1020;
    }
</style>
@endsection
