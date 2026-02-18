@extends('component.template')

@section('title')
    CMDLT | PatientCare
@endsection
@section('header')
    {{-- @include('component.menu_principal_v2') --}}
@endsection

@section('content')
    <header>

    </header>
    @php
    $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
    @endphp

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header p-0">
                    <nav class="navbar navbar-light bg-primary m-0 p-0 justify-content-end">
                        <a class="navbar-brand" href="#" data-dismiss="modal" aria-label="Close">
                            <img src="/image/system/logo-cmdlt-blanco.svg" style="height: 3em !important;width: 120px;"
                                alt="Image logo system" loading="lazy">
                        </a>
                    </nav>
                    <div id="modal-header-info-user">

                    </div>

                </div>
                <div class="modal-body p-0">

                    <div class="bg-light p-2">
                        <h3 class="text-primary">Reprogramar Cita</h3>
                        <table>
                            <tr>
                                <th class="text-secondary">Paciente:</th>
                                <td>Ramón Koens</td>
                            </tr>
                            <tr>
                                <th class="text-secondary">Médico:</th>
                                <td>Luis Eduardo Parodi</td>
                            </tr>
                            <tr>
                                <th class="text-secondary">Especialidad:</th>
                                <td>Urología Pediatrica</td>
                            </tr>
                        </table>

                    </div>
                    <form class="p-2" action="">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <main class="d-flex flex-column overflow-auto p-1" style="height:91vh;padding-bottom: 10vh !important;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-primary">Consulta Externa</h1>
                    <h2>{{ date('d') }} de {{ $meses[(int) (date('m') - 1)] }}, {{ date('Y') }}</h2>
                    <h3 class="text-secondary">Centro Médico Docente la trinidad</h3>
                </div>
            </div>
            <ul class="nav nav-pills  nav-fill mb-1" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="pills-opcion1-tab" data-toggle="pill" href="#pills-opcion1" role="tab"
                        aria-controls="pills-opcion1" aria-selected="true">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Nuevas Solicitudes</span>
                                <span class="info-box-number">0</span>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="pills-opcion2-tab" data-toggle="pill" href="#pills-opcion2" role="tab"
                        aria-controls="pills-opcion2" aria-selected="true">
                        <div class="info-box">
                            <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Atendidas</span>
                                <span class="info-box-number">0</span>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="pills-opcion3-tab" data-toggle="pill" href="#pills-opcion3" role="tab"
                        aria-controls="pills-opcion3" aria-selected="true">
                        <div class="info-box">
                            <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Reprogramadas</span>
                                <span class="info-box-number">0</span>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="pills-opcion4-tab" data-toggle="pill" href="#pills-opcion4" role="tab"
                        aria-controls="pills-opcion4" aria-selected="true">
                        <div class="info-box">
                            <span class="info-box-icon bg-danger"><i class="far fa-star"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">No Atendidas</span>
                                <span class="info-box-number">0</span>
                            </div>
                        </div>
                    </a>
                </li>

            </ul>

            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-opcion1" role="tabpanel"
                    aria-labelledby="pills-opcion1-tab">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="text-info">Nuevas Solicitudes</h3>
                            <table id="example0" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Paciente</th>
                                        <th>Doctor</th>
                                        <th>Especialidad</th>
                                        <th>Fecha Cita</th>
                                        <th>Hora</th>
                                        <th>¿Atendido?</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-opcion2" role="tabpanel" aria-labelledby="pills-opcion2-tab">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="text-success">Atendidas</h3>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Paciente</th>
                                        <th>Doctor</th>
                                        <th>Especialidad</th>
                                        <th>Fecha Cita</th>
                                        <th>Hora</th>
                                        <th>¿Atendido?</th>
                                    </tr>
                                </thead>
                                <tbody>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-opcion3" role="tabpanel" aria-labelledby="pills-opcion3-tab">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="text-warning shadow-sm">Reprogramadas</h3>
                            <table id="example2" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Paciente</th>
                                        <th>Doctor</th>
                                        <th>Especialidad</th>
                                        <th>Fecha Cita</th>
                                        <th>Hora</th>
                                        <th>¿Atendido?</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-opcion4" role="tabpanel" aria-labelledby="pills-opcion4-tab">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="text-danger shadow-sm">No Atendidas</h3>
                            <table id="example3" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Paciente</th>
                                        <th>Doctor</th>
                                        <th>Especialidad</th>
                                        <th>Fecha Cita</th>
                                        <th>Hora</th>
                                        <th>¿Atendido?</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </main>

    <footer>

    </footer>
    <template id="row-new-cita">
        <tr>
            <td>Paciente</td>
            <td>Medico</td>
            <td>Especialidad</td>
            <td>21 de febrero, 2022</td>
            <td>2:00 PM</td>
            <td>
                <div class="btn-group w-100 ">
                    <button class="btn btn-default btn-blockdropdown-toggle" type="button" id="triggerId"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Acciones
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="triggerId">
                        <a data-cita_id="0" data-status-cita="1" class="actions dropdown-item" href="#">Atendido</a>
                        <a data-cita_id="0" data-status-cita="3" class="actions dropdown-item" href="#">No Atendida</a>
                        <a data-cita_id="0" data-status-cita="2" class="actions dropdown-item" href="#">Reprogramar</a>
                        <a data-cita_id="0" data-status-cita="0" class="actions dropdown-item" href="#">Renovar</a>
                    </div>
                </div>
            </td>
        </tr>
    </template>
    <template id="formReprogramar">
        <div class="row">
            <div class="col-md-12">
                <b class="text-secondary">Fecha Agendada:</b> <span>17 de febrero, 2022 10:00 AM</span>
            </div>
            <div class="col-md-12 mt-2">
                <h5 class="text-primary">Ingrese nueva fecha:</h5>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label class="text-secondary" for="fecha">Fecha</label>
                    <input type="date" name="fecha" id="fecha" class="form-reprogramar form-control" placeholder=""
                        aria-describedby="helpId">
                    <small id="helpId" class="text-muted"></small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="text-secondary" for="hour">Hora</label>
                    <input type="time" name="hour" id="hour" class="form-reprogramar form-control" placeholder=""
                        aria-describedby="helpId">
                    <small id="helpId" class="text-muted"></small>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label class="text-secondary" for="coment">Comentarios</label>
                    <textarea name="coment" id="coment" class="form-reprogramar form-control" cols="3"
                        aria-describedby="helpId" rows="3"></textarea>
                    <small id="helpId" class="text-muted"></small>
                </div>
            </div>
        </div>
    </template>
    <template id="formAtendido">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="text-secondary" for="coment">Comentarios</label>
                    <textarea name="coment" id="coment" class="form-control" cols="3"
                        aria-describedby="helpId" rows="3"></textarea>
                    <small id="helpId" class="text-muted"></small>
                </div>
            </div>
        </div>
    </template>
@endsection
@section('footer')
@endsection


@section('script')

    <script>
        let d = document
        let citas = @json($citas, JSON_PRETTY_PRINT);
        var $table1
        var $table2
        var $table3
        var $table4
            function filtrosDatatables(){
                $table1 = $('#example0').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                });
                $table2 = $('#example1').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                });
                $table3 = $('#example2').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                });
                $table4 = $('#example3').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                });
                $('#search').on('change',function (param) {

                    tablePacientes.search($(this).val()).draw()

                })
            }
            async function handleStoreReprogramar(){
                let status = useState.formReprogramar

                    console.log()
                    //d.querySelector(`.dataTables_empty`)?.remove()
                let formData = new FormData();
                    for (const key in useState.formReprogramar) {
                        if (Object.hasOwnProperty.call(useState.formReprogramar, key)) {
                            let element = useState.formData[key];
                                formData.append(key,element)
                        }
                    }


                    formData.append("created_at", timestamps() )
                    formData.append("_token", entById('_token').value )
                    await post("/medico/cita/reprogramar",formData)
                    useState.set_atendido(cita_id,status)
                    d.querySelector(`.row-cita-${cita_id}`).remove()
            }
            function handleReprogramar(e,cita_id){

                $("#exampleModal").modal("show")
                let $modal = d.querySelector(`#exampleModal`)
                let $formReprogramar = entById('formReprogramar').content
                    $formReprogramar = d.importNode($formReprogramar, true);

                let cita = useState.get_cita( e.target.dataset.cita_id )

                let header = $modal.querySelectorAll(`table td`)
                    header[0].textContent = cita.paciente
                    header[1].textContent = cita.medico
                    header[2].textContent = cita.especialidad_nombre
                    console.log( cita )

                    $modal.querySelector(".modal-body form").innerHTML=null
                    $modal.querySelector(".modal-body form").append($formReprogramar)
                let $div = $modal.querySelectorAll("form div")
                        //console.log( $modal )
                    $div[1].querySelector("span").textContent = fechaTextoCustom1({"day":cita.day,"month_name":cita.mes_nombre,"year":cita.year,})
                    console.log( $modal.querySelector(".modal-body"))
                    useState.add_row_to_table_table_filted(cita_id,2)
                let footer = $modal.querySelectorAll(`.modal-footer button`)
                    footer[1].removeEventListener("click", e=>{}, true);
                    footer[1].addEventListener("click",e=>{
                        handleStoreReprogramar()
                    })
            }
        let useState =
            {
                formReprogramar:{
                    fecha:"aaaa-mm-dd",
                    year:"aaaa",
                    month:"mm",
                    day:"dd",
                    hour:"00:00",
                    coment:"",
                    created_at: timestamps()
                },
                citas:[],
                set_citas:function(citas){
                    this.citas = citas
                },
                get_citas:function(){
                    return this.citas
                },
                get_cita_key:function(cita_id){
                    let response
                    let p = true
                        this.citas.forEach( ( cita, key ) => {
                            if ( equalsInt(cita.id , cita_id) && p) {
                                response = key
                                p=false;
                            }
                        } )
                        return response
                },
                get_cita:function(cita_id){
                    return first( this.citas.filter( cita => equalsInt(cita.id , cita_id) ) )
                },
                set_atendido:function(cita_id,value){
                    /*
                        0 -> Pendiente
                        1 -> atendido
                        2 -> reprogramado
                        3 -> No Atendido
                    */
                    //console.log(cita_id)
                    //console.log("------->",this.get_cita_key( cita_id ))
                    //console.log(this.citas[ this.get_cita_key( cita_id ) ])
                    this.citas[ this.get_cita_key( cita_id ) ] ['status'] = value
                },
                get_table_filted:function(filter){
                    let $fragment = d.createDocumentFragment()
                        this.get_citas_filtred(filter.status).forEach(cita => {
                            $fragment.append( this.tableRow(cita) )
                        })

                    let $table = d.querySelector(`#example${filter.table} tbody`)
                        $table.innerHTML =null
                        $table.append($fragment)
                        this.get_totales()
                },
                add_row_to_table_table_filted:function(cita_id,table_number){
                    let cita = this.get_cita(cita_id)
                    let $table = d.querySelector(`#example${table_number} tbody`)
                        $table.append( this.tableRow(cita) )
                        this.get_totales()
                },
                add_rows_to_table_filtered:function(filter){
                    let $fragment = d.createDocumentFragment()
                        this.get_citas_filtred(filter.status).forEach(cita => {
                            $fragment.append( this.tableRow(cita) )
                        })

                    let $table = d.querySelector(`#example${filter.table} tbody`)
                        $table.innerHTML =null
                        $table.append($fragment)
                        this.get_totales()
                },
                add_rows_to_table_new_citas:function(){
                    let $fragment = d.createDocumentFragment()
                        this.get_citas().forEach(cita => {
                            $fragment.append( this.tableRow(cita) )
                        })

                    let $table = d.querySelector(`#example1 tbody`)
                        $table.innerHTML =null
                        $table.append($fragment)
                        this.get_totales()
                },
                tableRow:function(cita){

                    let $row_new_cita = entById('row-new-cita').content
                        $row_new_cita = d.importNode($row_new_cita, true);
                    let $row = $row_new_cita.querySelector('tr')
                        $row.classList.add(`row-cita-${cita.id}`)
                    let $td = $row_new_cita.querySelectorAll('td')
                        $td[0].textContent = cita.paciente
                        $td[1].textContent = cita.medico
                        $td[2].textContent = cita.especialidad_nombre

                        $td[3].innerHTML = fechaTextoCustom1({"day":cita.day,"month_name":cita.mes_nombre,"year":cita.year,})

                        $td[4].textContent = cita.hour

                    let $actions = $td[5].querySelectorAll("a").forEach( x=> x.dataset.cita_id = cita.id )


                        return $row_new_cita
                },
                get_citas_filtred:function(status){
                    return this.get_citas().filter( citas => equalsInt( citas.status, status) )
                },
                get_totales:function(){
                    let $totales = d.querySelectorAll("ul.nav.nav-pills .info-box-number")

                        $totales[0].textContent = Object.keys( this.get_citas_filtred(0) ).length
                        $totales[1].textContent = Object.keys( this.get_citas_filtred(1) ).length
                        $totales[2].textContent = Object.keys( this.get_citas_filtred(2) ).length
                        $totales[3].textContent = Object.keys( this.get_citas_filtred(3) ).length
                }
            }

            useState.set_citas(citas)

            for (let index = 0; index < 3; index++) {
                useState.add_rows_to_table_filtered({"status":index,"table":index})
            }

            setTimeout(() => {
                for (let index = 0; index < 3; index++) {
                    useState.add_rows_to_table_filtered({"status":index,"table":index})
                }
            }, 10000);

            d.querySelector("#exampleModal").addEventListener("change", async function (e) {
                //console.log(e.target)
                if (e.target.matches(".form-reprogramar")) {
                    let new_reprogramar =
                        {
                            "year":"",
                            "month":"",
                            "day":"",
                            "coment":"",
                            "cita_id":""
                        }
                        if (e.target.name === "fecha") {
                            //console.log(e.target.value)
                            let fecha = e.target.value.split("-")

                                new_reprogramar['year'] = fecha[2]
                                new_reprogramar["month"] = fecha[1]
                                new_reprogramar["day"] = fecha[0]

                        }
                        new_reprogramar["coment"] = e.target.value
                        useState.formReprogramar = new_reprogramar
                }
                console.log(useState.formReprogramar)
            })
            d.addEventListener("click", async function (e) {
                if (e.target.matches("a.actions")) {
                    let status = parseInt(e.target.dataset.statusCita)
                    let cita_id = parseInt(e.target.dataset.cita_id)
                        //d.querySelector(`.dataTables_empty`)?.remove()
                    let formData = new FormData();
                        formData.append("cita_id",cita_id)
                        formData.append("status",status)
                        formData.append("_token", entById('_token').value )
                        await post("/consultaexterna/medico/cita/status",formData)
                        useState.set_atendido(cita_id,status)
                        d.querySelector(`.row-cita-${cita_id}`).remove()

                    switch (status) {
                        case 0:
                            useState.add_row_to_table_table_filted(cita_id,0)
                            //$table1.draw(false)
                        break;
                        case 1:
                            useState.add_row_to_table_table_filted(cita_id,1)
                            //$table2.draw(false)
                        break;
                        case 2://reprogramar
                            handleReprogramar(e,cita_id)

                            //$table3.draw(false)
                        break;
                        case 3:
                            useState.add_row_to_table_table_filted(cita_id,3)
                            //$table4.draw(false)
                        break;
                        default:
                        break;
                    }
                }
            })
    </script>

    <script>
        headerNav({})
    </script>
@endsection
@section('css')
    <style>
        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            color: var(--secondary);
            background-color: whitesmoke;
        }

    </style>
@endsection
