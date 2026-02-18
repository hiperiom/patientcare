import {navbarBrand} from './navbar-brand.js'

export const 	navbarHomeBtn  = ({
    id      = "navbarBrand",
    href    = "#",
    imgSrc  = "http://via.placeholder.com/150",
    width   = "2.5em",//100px
    height  = "2.5em",//40px
    texto   = "",
    padding = "0",
    margin = "0",
    rounded ="",
    customClass = ""
}) =>
{


    return `

    <div class="container-fluid">
        <ul class="navbar-nav align-items-center me-auto">
            <li class="nav-item dropdown">
                <div class="d-flex align-items-center  flex-row" id="menuPatientcare" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="">
                        <img src="https://placeimg.com/640/480/any" style="width: 3em;height: 3em;" class="img-fluid rounded-circle" alt="...">
                    </div>
                    <div class="px-1">
                        Luis Eduardo Parodi Arrieta
                    </div>
                </div>

                <ul class="dropdown-menu dropdown-menu-light p-0" aria-labelledby="menuPatientcare">
                    <li>
                        <a href="#" class="list-group-item list-group-item-action bg-primary">
                            <img src="../image/system/patientCare_bw.svg" alt="6.25emx2.5em" style="width:6.25em;height:2.5em;margin:0;padding:0;" class="d-flex mx-auto img-fluid  ">
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item p-2 scale-up-ver-top" href="/medico"><i class="fas fa-home text-primary"></i> Inicio</a>
                    </li>
                    <li>
                        <a class="dropdown-item p-2 scale-up-ver-top" href="/medico/index_medicos">
                            <i class="fas fa-user-md text-primary"></i>
                            Equipo Médico
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item p-2 scale-up-ver-top" href="#" onclick="CatUserEspecialidad.menuEspecialidad('.modal-body')" >
                            <i class="fas fa-notes-medical text-primary"></i>
                            Especialidades
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item p-2 scale-up-ver-top" href="/paciente/pendiente">
                            <i class="fas fa-users text-primary"></i>
                            Nuevos Pacientes
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item p-2 scale-up-ver-top" href="#" onclick="UserCuestEpisodio.indexEpisodioCIE11({})" >
                            <i class="fas fa-book-medical text-primary"></i>
                            Clasificador CIE-11
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item p-2 scale-up-ver-top" href="#" onclick="UserCuestEpisodio.indexEntregaGuardia({})" >
                            <i class="fas fa-address-book text-primary"></i>
                            Entrega de guardia
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item p-2 scale-up-ver-top  " href="/paciente/create"><i class="fas fa-external-link-alt text-primary"></i>
                            Cuestionario covid
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item p-2 scale-up-ver-top  " href="/finalizarSesion">
                            <i class="fas fa-sign-out-alt text-primary"></i>
                            Salir
                        </a>
                    </li>
                </ul>
            </li>
        </ul>

    </div>

    `;

}//fin funcion
