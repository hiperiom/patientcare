<nav id="headerNavbar" class="navbar navbar-expand navbar-primary justify-content-between navbar-light navbar-v2">
    <div id="homeButtomMenu">
        <div class="btn-group dropleft float-left">
            <a  onclick="location.href='/auth/menu_inicial_principal'" class="dropdown-toggle-split  heartbeat cursor-pointer" id="dropdownMenuReference"   style="height: 1cm;width: 100%;line-height: 1 !important;">
                <div class="d-flex row-flex">
                    <div>
                        <img id="img_profile" onerror="this.src = '/image/system/medic.svg'" class="float-right border border-white rounded-circle" style="height: 1.1cm;width:1.1cm" src="{{ session('userData')['imagen'] }}" alt="">
                    </div>
                    <div class=" pl-2">
                        <div class="text-white">
                            @if (isset(session('userData')["genero"]) && session('userData')["genero"]=="f")
                                ¡Bienvenida!
                            @else
                                ¡Bienvenido!
                            @endif
                        </div>

                        <div class="text-white" style="font-weight: bold;font-size: 1.5em;height: 1em;overflow: hidden;">
                            {{!is_null(session('userData')["prefijo"])?session('userData')["prefijo"]:""}} {{session('userData')["nombre"]}} {{session('userData')["apellido"]}}
                        </div>
                    </div>
                </div>
            </a>
            {{-- <div class="dropdown-menu" aria-labelledby="dropdownMenuReference" style="z-index: 1065;padding: 0;">
                <a href="#" class="list-group-item list-group-item-action bg-primary">
                    Menú Patientcare
                    </a>
                <a class="dropdown-item p-2 scale-up-ver-top  " href="/medico"><i class="fas fa-home text-primary"></i> Inicio</a>
                <a class="dropdown-item p-2 scale-up-ver-top  " href="/medico/index_medicos"><i class="fas fa-user-md text-primary"></i> Equipo
                    Médico</a>

                @if(Request::is('medico'))
                    <a class="dropdown-item p-2 scale-up-ver-top cursor-pointer" onclick="CatUserEspecialidad.menuEspecialidad('.modal-body')" >
                        <i class="fas fa-notes-medical text-primary"></i>
                        Especialidades
                    </a>
                @endif


                <a class="dropdown-item p-2 scale-up-ver-top  " href="/paciente/pendiente"><i class="fas fa-users text-primary"></i> Nuevos
                    Pacientes</a>
                <a class="dropdown-item p-2 scale-up-ver-top cursor-pointer" onclick="UserCuestEpisodio.indexEpisodioCIE11({})" >
                    <i class="fas fa-book-medical text-primary"></i>
                    Clasificador CIE-11
                    </a>
                <a class="dropdown-item p-2 scale-up-ver-top cursor-pointer" onclick="UserCuestEpisodio.indexEntregaGuardia({})" >
                    <i class="fas fa-address-book text-primary"></i>
                    Entrega de guardia
                </a>
                  <!--
                  <a class="dropdown-item p-2 scale-up-ver-top cursor-pointer" onclick="SystemIncidencia.index({})" >
                    <i class="fas fa-clipboard-check text-primary"></i>
                    Incidencias Patientcare <span data-tippy-content='Pendientes' class="badge badge-pill tooltip-danger badge-danger">4</span>
                    </a> -->
                 <a class="dropdown-item p-2 scale-up-ver-top  " href="/paciente/create"><i class="fas fa-external-link-alt text-primary"></i>
                    Cuestionario covid</a>

                <div class="dropdown-divider"></div>
                <a class="dropdown-item p-2 scale-up-ver-top  " href="/finalizarSesion"><i class="fas fa-sign-out-alt text-primary"></i> Salir</a>
            </div> --}}
        </div>
    </div>
    <div>
        <a id="logoSystem" href="/medico"><img class="" loading="lazy" style="height: 4em;width: 10em;" src="{{ asset('image/system/patientcare_bw.svg') }}"></a>

    </div>



</nav>
