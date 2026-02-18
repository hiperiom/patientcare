<nav class="d-flex justify-content-end  bg-gray p-1"  style="   height: 60px;">
    <button onclick="location.href='/auth/menu_inicial_principal'" class="btn bg-transparent d-flex align-items-center" type="button" >
        <div class="d-flex flex-column align-items-end">
            <span class="text-white">
                @if (isset(session('userData')["genero"]) && session('userData')["genero"]=="f")
                    ¡Bienvenida!
                @else
                    ¡Bienvenido!

                @endif
            </span>

            <b class="text-white text-nowrap" >
                {{!is_null(session('userData')["prefijo"])?session('userData')["prefijo"]:""}} {{session('userData')["nombre"]}} {{session('userData')["apellido"]}}
            </b>


        </div>
        <img id="img_profile" onerror="this.src = '/image/system/medic.svg'"
            class="ml-1 border border-white rounded-circle" style="height: 1.1cm;width:1.1cm"
            src="{{ session('userData')['imagen'] }}" alt="">

    </button>
    {{-- <div class="dropdown"> --}}
        {{-- <button class="btn bg-transparent dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span style="position: absolute;right:70px;top:0px;text-align:right;height: 65px;width: 300px;/*border:1px solid red*/">
                <span class="text-white" style="position: absolute;right:-10px;top: 0px;">
                    @if (isset(session('userData')["genero"]) && session('userData')["genero"]=="f")
                        ¡Bienvenida!
                    @else
                        ¡Bienvenido!

                    @endif
                </span>
                <br>
                <span class="text-white text-nowrap" style="position: absolute;right:-10px;top: 15px;font-weight: bold;font-size: 1.5em;">
                    {{!is_null(session('userData')["prefijo"])?session('userData')["prefijo"]:""}} {{session('userData')["nombre"]}} {{session('userData')["apellido"]}}
                </span>
                <br>
                <span class="text-primary" style="position: absolute;right:5px;font-size: 0.8em;">
                    <!-- Su última visita fue hace 7 horas. -->
                </span>
            </span>
            <img id="img_profile" onerror="this.src = '/image/system/medic.svg'"
                class="float-right border border-white rounded-circle" style="height: 1.1cm;width:1.1cm"
                src="{{ session('userData')['imagen'] }}" alt="">

        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="z-index: 1065;padding: 0;">
            <a href="#" class="list-group-item list-group-item-action bg-primary">
                Menú Patientcare
                </a> --}}

            {{--  <a class="dropdown-item p-2 scale-up-ver-top  " href="/auth/navegationHome"><i class="fas fa-home text-primary"></i> Inicio</a> --}}
            {{-- <a class="dropdown-item p-2 scale-up-ver-top  " href="/medico"><i class="fas fa-home text-primary"></i> Inicio</a>
            @if (session('userData')["especialidad_id"] == 62)

            @endif
            <a class="dropdown-item p-2 scale-up-ver-top  " href="/medico/index_medicos"><i class="fas fa-user-md text-primary"></i> Equipo
                Médico</a>

            @if(Request::is('medico')) --}}
                {{-- <a class="dropdown-item p-2 scale-up-ver-top cursor-pointer" onclick="CatUserEspecialidad.menuEspecialidad('.modal-body')" >
                    <i class="fas fa-notes-medical text-primary"></i>
                    Especialidades
                </a> --}}
           {{--  @endif --}}


            {{-- <a class="dropdown-item p-2 scale-up-ver-top  " href="/paciente/pendiente"><i class="fas fa-users text-primary"></i> Nuevos
                Pacientes</a> --}}
            {{-- <a class="dropdown-item p-2 scale-up-ver-top cursor-pointer" onclick="UserCuestEpisodio.indexEpisodioCIE11({})" >
                <i class="fas fa-book-medical text-primary"></i>
                Clasificador CIE-11
                </a> --}}
            {{-- <a class="dropdown-item p-2 scale-up-ver-top cursor-pointer" onclick="UserCuestEpisodio.indexEntregaGuardia({})" >
                <i class="fas fa-address-book text-primary"></i>
                Entrega de guardia
            </a> --}}
            {{-- <a class="dropdown-item p-2 scale-up-ver-top  " target="_blank" href="/reportes/pad/resumen"><i class="fas fa-home text-primary"></i>
                Dashboard PAD</a> --}}
                <!--
                <a class="dropdown-item p-2 scale-up-ver-top cursor-pointer" onclick="SystemIncidencia.index({})" >
                <i class="fas fa-clipboard-check text-primary"></i>
                Incidencias Patientcare <span data-tippy-content='Pendientes' class="badge badge-pill tooltip-danger badge-danger">4</span>
                </a> -->
            {{--
                <a class="dropdown-item p-2 scale-up-ver-top  " target="_blank" href="/reportes/hospitalizacion/resumen"><i class="pc-solid-pisos text-primary"></i>
                Dashboard Hospitalización</a> --}}
                {{-- <a class="dropdown-item p-2 scale-up-ver-top  " href="/paciente/create"><i class="fas fa-external-link-alt text-primary"></i>
                Cuestionario covid</a> --}}
                {{-- <a class="dropdown-item p-2 scale-up-ver-top  " href="/paciente/post_covid_index"><i class="fas fa-external-link-alt text-primary"></i>
                Clínica PostCovid</a> --}}
                {{-- <a class="dropdown-item p-2 scale-up-ver-top  btn-telesaludEmpresarial" href="/telesalud/empresarial/index"><i class="fas fa-building text-primary"></i>
                Telesalud Empresarial</a>
                <a class="dropdown-item p-2 scale-up-ver-top  btn-telesaludEmpresarial" href="/areaQuirofano/index_quirofano"><i class="pc-cirugia-solid text-primary"></i>
                Área de Quirófano</a>

            <div class="dropdown-divider"></div>
            <a class="dropdown-item p-2 scale-up-ver-top  " href="/finalizarSesion"><i class="fas fa-sign-out-alt text-primary"></i> Salir</a>
        </div>
    </div>
 --}}
</nav>


