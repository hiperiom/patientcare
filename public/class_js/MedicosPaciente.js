import { post, timestamps } from '../helpers/helpers';

let AppResumeHealthTeam = function (episodio_id) {
  let app = new Vue({
    el: '#AppResumeHealthTeam',
    template: `
      <div class="flex-fill p-1 card overflow-hidden">
        <ul class="nav nav-tabs p-0 m-0 flex-nowrap" id="myTab" role="tablist">
          <li class="nav-item p-0 m-0" role="presentation">
            <a class="nav-link p-0 m-0 px-2 active" id="equipoEspecialistas-tab" data-toggle="tab"
              href="#equipoEspecialistas" role="tab" aria-controls="equipoEspecialistas" aria-selected="true">
              <b class="text-center text-primary" style="font-size:0.8em;">Médicos</b>
            </a>
          </li>
          <li class="nav-item p-0 m-0" role="presentation">
            <a class="nav-link p-0 px-2 m-0" id="equipoEnfermeria-tab" data-toggle="tab" href="#equipoEnfermeria" role="tab"
              aria-controls="equipoEnfermeria" aria-selected="false">
              <b class="text-center text-warning" style="font-size:0.8em;">Enfermería</b>
            </a>
          </li>
        </ul>
        <div class="tab-content " id="myTabContent">
          <div class="tab-pane fade show active" id="equipoEspecialistas" role="tabpanel"
            aria-labelledby="equipoEspecialistas-tab">

            <div class="p-0"> 
              <ul class="list-group list-group-flush">
                <li v-for="(item,index) in resumeTeam.filter(x=>x.team_id!==6)" :key="index" data-toggle="tooltip"
                  data-placement="top" :title="'Equipo '+item.name" :data-custom-class="'tooltip-'+item.color "
                  class="list-group-item list-group-item-action p-0 cursor-pointer" @click="getTeamList(item.team_id)">
                  <div class="d-flex flex-column">
                    <div class="d-flex align-items-center ">
                      <div :class="['badge mx-2','badge-'+item.color]" style="width:25px">
                        {{item.siglas}}
                      </div>
                      <img v-if="getLastMedic(item.team_id)" loading="lazy" style="width:20px;height:20px;border-radius:20px;" class="img-doctor mx-1"
                        onerror="this.src='https://placehold.co/30x30'" :src="getLastMedic(item.team_id).medico_img">
                   
                      <div class="text-nowrap position-relative d-flex align-items-center">
                        <div >{{getLastMedic(item.team_id) ? getLastMedic(item.team_id).medico : item.name}}</div>
                      
                        <span 
                        v-if="item.team_id !== 2 && episode?.medico_paciente.filter(x=>x.team_id===item.team_id).length > 1"
                        class="bg-gray text-secondary ml-2 px-1 rounded " style="top:-5px;font-size: 0.7rem;">
                        +{{episode?.medico_paciente.filter(x=>x.team_id===item.team_id).length}}
                        </span>
             
                      </div>
                    </div>

                  </div>
                </li>
              </ul>
            </div>

          </div>
          <div class="tab-pane fade" id="equipoEnfermeria" role="tabpanel" aria-labelledby="equipoEnfermeria-tab">
            <div class="p-0">
              <ul class="list-group list-group-flush">
                <li v-for="(item,index) in resumeTeam.filter(x=>x.team_id===6)" :key="index" data-toggle="tooltip"
                  data-placement="top" :title="'Equipo '+item.name" :data-custom-class="'tooltip-'+item.color "
                  class="list-group-item list-group-item-action p-0 cursor-pointer" @click="getTeamList(item.team_id)">
                  <div class="d-flex flex-column">
                    <div class="d-flex align-items-center ">
                      <div :class="['badge mx-2','badge-'+item.color]" style="width:25px">
                        {{item.siglas}}
                      </div>
                      <img v-if="getLastMedic(item.team_id)" loading="lazy" style="width:20px;height:20px;border-radius:20px;" class="img-doctor mx-1"
                        onerror="this.src='https://placehold.co/30x30'" :src="getLastMedic(item.team_id).medico_img">
                   
                      <div class="text-nowrap position-relative d-flex align-items-center">
                        <div >{{getLastMedic(item.team_id) ? getLastMedic(item.team_id).medico : item.name}}</div>
                      
                        <span 
                        v-if="item.team_id !== 2 && episode?.medico_paciente.filter(x=>x.team_id===item.team_id).length > 1"
                        class="bg-gray text-secondary ml-2 px-1 rounded " style="top:-5px;font-size: 0.7rem;">
                        +{{episode?.medico_paciente.filter(x=>x.team_id===item.team_id).length}}
                        </span>
             
                      </div>
                    </div>

                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="healthTeamModal" tabindex="-1" aria-labelledby="healthTeamModalLabel"
          aria-hidden="true">
          <div class="modal-dialog modal-xl" style="padding: 3rem;">
                <div class="modal-content" 
                    style="
                        height: 90vh;
                        width: 95vw;
                    "
                >
    
              <div
                :class="['modal-header d-flex align-items-center justify-content-between text-white','bg-'+currentModalTeam?.color]">
                <h5 class="modal-title">Equipo {{currentModalTeam?.name}}</h5>
                <button type="button" class="btn btn-default p-1" @click="handleCloseModal" aria-label="Close">
                  <span class="text-white" aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body d-flex p-0 overflow-auto" style="height: 75vh;">
                <div class="col-12 col-md-6 p-0 d-flex flex-column">
                  <div class="p-1">
                    <div 
                      class="text-dark" 
                      style="    
                        font-size: 1.2rem;
                        font-weight: 500;
                      "
                    >
                      Añadir nuevo {{currentModalTeam?.name}}:
                    </div>
                    <input 
                      type="search" 
                      v-model="searchQuery"
                      :placeholder="'Escribe '+currentModalTeam?.name+' a buscar...'"
                      class="form-control"
                    >
                    <div class="alert alert-warning my-1">
                      <b>Pulsa</b> en un {{currentModalTeam?.team_id!==6?'médico':'personal de enfermería'}} del siguiente listado para asignarlo al paciente.
                    </div>
                  </div>
                  <div class="flex-fill d-flex flex-column overflow-auto p-1">
                    <ul class="mt-1 list-group">
                      <template v-for="(especiality,index) in filteredHealthTeam" >
                        <li 
                          
                          :key="index" 
                          style="font-weight: 500 !important;"
                          :class="['list-group-item d-flex flex-column list-group-item-action p-0','text-'+currentModalTeam?.color]"
                        >
                          <div class="pl-1 w-100 border-bottom">{{especiality.name}}</div>
                          <ul class="mt-1 list-group list-group-flush">
                            <template v-for="(team,index2) in especiality.healthTeam" >
                              <li 
                                :key="index2" 
                                style="font-weight: 500 !important;"
                                :class="['list-group-item d-flex flex-column list-group-item-action p-1',{['active-'+currentModalTeam?.color]:is_assigned(team)}
                                
                                ]"
                                @click="addTeam(team)"  
                              >
                                <div class="d-flex align-items-center" style="gap:3px;">
                                    <img loading="lazy" style="width:20px;height:20px;border-radius:20px;" class="img-doctor mx-1" onerror="this.src='https://placehold.co/30x30'" :src="team.imagen">
                                    <div>{{team.medico}}</div>
                                </div>
                                
                                <div class="d-flex" style="gap:3px;">
                                  <button v-if="!['null',null,'undefined',undefined].includes(team.telefono_movil)" class="btn btn-outline-success btn-sm px-1" style="height:20px;font-size:0.7rem;line-height: 0.5;"><i class="ml-1 fab fa-whatsapp text-success"></i>{{team.telefono_movil}}
                                  </button>
                                  <button v-if="!['null',null,'undefined',undefined].includes(team.extension_telefonica)" class="btn btn-outline-primary btn-sm px-1" style="height:20px;font-size:0.7rem;line-height: 0.5;"><i class="ml-1 fas fa-phone"></i> {{team.extension_telefonica}}
                                  </button>

                                </div>
                              </li>
                            </template>
                          </ul>
                        </li>
                        
                      </template>
                    </ul>
                  </div>
                  <div class="text-center ">Mostrando <b>{{showingTotal}}</b> resultados</div>
                </div>
                <div class="col-12 col-md-6 p-0 d-flex flex-column">
                  <div class="p-1">
                    <div 
                      class="text-dark" 
                      style="    
                        font-size: 1.2rem;
                        font-weight: 500;
                      "
                    >
                      Equipo {{currentModalTeam?.name}}:
                    </div>
                    <ul v-if="currentModalTeam?.team_id==2" class="nav nav-tabs justify-content-end" id="myTab" role="tablist">
                      <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="assigns-tab" data-toggle="tab" data-target="#assigns" type="button" role="tab" aria-controls="assigns" aria-selected="true">
                          Solicitadas 
                          <span v-if="episode?.interconsultation_request.filter(x=>!x.fecha_confirmacion).length > 0" :class="['badge badge-'+currentModalTeam?.color]">
                            {{episode?.interconsultation_request.filter(x=>!x.fecha_confirmacion).length}}
                          </span>
                        </button>
                      </li>
                    
                      <li class="nav-item" role="presentation">
                        <button class="nav-link" id="answered-tab" data-toggle="tab" data-target="#answered" type="button" role="tab" aria-controls="answered" aria-selected="false">
                          Completadas 
                          <span v-if="episode?.interconsultation_request.filter(x=>x.fecha_confirmacion).length > 0" :class="['badge badge-'+currentModalTeam?.color]">{{episode?.interconsultation_request.filter(x=>x.fecha_confirmacion).length}}</span></button>
                      </li>
                    </ul>
                  </div>
                  <div class="tab-content flex-fill d-flex flex-column overflow-auto p-1" id="myTabContent">
                    <div :class="['tab-pane fade show active',{'active':currentModalTeam?.team_id==2}]" id="assigns" role="tabpanel" aria-labelledby="assigns-tab">
                      <div class="p-1">
                        <ul class="mt-1 list-group list-group-flush">
                          <template v-if="medicos_paciente?.length > 0">
                            <li 
                                 v-for="(team,index2) in medicos_paciente"
                              :key="index2" 
                              style="font-weight: 500 !important;"
                              :class="['list-group-item d-flex align-items-center list-group-item-action p-1']"
                            >
                              <div class="d-flex flex-column ">
                                <div class="d-flex align-items-center" style="gap:3px;">
                                    <img loading="lazy" style="width:20px;height:20px;border-radius:20px;" class="img-doctor mx-1" onerror="this.src='https://placehold.co/30x30'" :src="team.medico_img">
                                    <div>{{team.medico}}</div>
                                </div>
                                <div class="d-flex" style="gap:3px;">
                                  <button v-if="team.telefono_movil" class="btn btn-outline-success btn-sm px-1" style="height:20px;font-size:0.7rem;line-height: 0.5;">
                                    <i class="ml-1 fab fa-whatsapp text-success"></i>{{team.telefono_movil}}
                                  </button>
                                  <button v-if="team.extension_telefonica" class="btn btn-outline-primary btn-sm px-1" style="height:20px;font-size:0.7rem;line-height: 0.5;"><i class="ml-1 fas fa-phone"></i> {{team.extension_telefonica}}</button>

                                </div>
                              </div>
                    
                              <div class="ml-auto d-flex" style="gap:3px;font-size:0.9rem;">
                                <div v-if="currentModalTeam?.team_id==2 && episode?.interconsultation_request.filter(x=>!x.fecha_confirmacion && x.doctor_id === team.user_id_medico).length > 0" class="flex-column text-right mr-1" style="line-height: 1.2;">
                                    <div>Fecha y hora de solicitud</div>
                                    <div>
                                        <span :class="'text-secondary'">
                                            <i class="fas fa-calendar-alt"></i>  {{episode?.interconsultation_request.find(x=>!x.fecha_confirmacion && x.doctor_id === team.user_id_medico).fecha_solicitud}}
                                        </span>
                                    </div>	
                                </div>
                                <div v-if="currentModalTeam?.team_id==2 && episode?.interconsultation_request.filter(x=>!x.fecha_confirmacion && x.doctor_id === team.user_id_medico).length > 0" class="flex-column text-right mr-1" style="line-height: 1.2;">
                                    <div>Tiempo transcurrido</div>
                                    <div>
                                        <span :class="['text-'+episode?.interconsultation_request.find(x=>!x.fecha_confirmacion && x.doctor_id === team.user_id_medico).color_tiempo_transcurrido]">
                                            <i class="fas fa-clock"></i>  {{episode?.interconsultation_request.find(x=>!x.fecha_confirmacion && x.doctor_id === team.user_id_medico).tiempo_transcurrido}}
                                        </span>
                                    </div>	
                                </div>
                                
                                <button 
                                  v-if="currentModalTeam?.team_id==2"  
                                  @click="
                                  episode?.interconsultation_request.filter(x=>!x.fecha_confirmacion && x.doctor_id === team.user_id_medico).length === 0
                                  ? addInterconsultation(team)
                                  : finishInterconsultation(team,  episode?.interconsultation_request.find(x=>!x.fecha_confirmacion && x.doctor_id === team.user_id_medico).id)
                                  " 
                                  :class="[
                                    'btn btn-sm',
                                    episode?.interconsultation_request.filter(x=>!x.fecha_confirmacion && x.doctor_id === team.user_id_medico).length > 0 ? 'btn-success': 'btn-info'
                                  ]"
                                ><i :class="currentModalTeam?.team_id==2 && episode?.interconsultation_request.filter(x=>!x.fecha_confirmacion && x.doctor_id === team.user_id_medico).length > 0 ? 'fas fa-hand-holding-medical': 'far fa-bell text-white'"></i>
                                </button>
                                <button 
                                v-if="episode?.interconsultation_request.filter(x=>!x.fecha_confirmacion && x.doctor_id === team.user_id_medico).length === 0"
                                @click="deleteTeam(team)" 
                                class="btn btn-danger btn-sm"
                                ><i class="fas fa-minus"></i>
                              </div>
                              
                            </li>
                          </template>
                          <template v-else>
                            <li 
                              style="font-weight: 500 !important;"
                              :class="['list-group-item justify-content-center d-flex align-items-center list-group-item-action p-1']"
                            >
                              No se encontró {{currentModalTeam?.name}}.
                            </li>
                          </template>
                        </ul>
                    
                      </div>
                    </div>
                    <div :class="['tab-pane fade',{'d-none':currentModalTeam?.team_id!==2}]" id="answered" role="tabpanel" aria-labelledby="answered-tab">
                      <div class="p-1">
                        <ul class="mt-1 list-group list-group-flush">
                          <template v-if="episode?.interconsultation_request.filter(x=>x.fecha_confirmacion).length > 0" >
                            <li 
                              v-for="(team,index2) in episode?.interconsultation_request.filter(x=>x.fecha_confirmacion)" 
                              :key="index2" 
                              style="font-weight: 500 !important;"
                              :class="['list-group-item d-flex align-items-center list-group-item-action p-1']"
                            >
                              <div class="d-flex flex-column ">
                                <div class="d-flex align-items-center" style="gap:3px;">
                                    <img loading="lazy" style="width:20px;height:20px;border-radius:20px;" class="img-doctor mx-1" onerror="this.src='https://placehold.co/30x30'" :src="team.imagen_medico">
                                    <div>{{team.medico}}</div>
                                </div>
                                <div class="d-flex" style="gap:3px;">
                                  <button v-if="team.telefono_movil" class="btn btn-outline-success btn-sm px-1" style="height:20px;font-size:0.7rem;line-height: 0.5;"><i class="ml-1 fab fa-whatsapp text-success"></i>{{team.telefono_movil}}
                                  </button>
                                  <button v-if="team.extension_telefonica" class="btn btn-outline-primary btn-sm px-1" style="height:20px;font-size:0.7rem;line-height: 0.5;"><i class="ml-1 fas fa-phone"></i> {{team.extension_telefonica}}</button>

                                </div>
                              </div>
                              <div class="ml-auto d-flex" style="gap:3px;font-size:0.9rem;">
                                <div class="flex-column text-right pr-1 mr-1" style="border-right: 1px solid #dee2e6 !important;line-height: 1.2;">
                                    <div>Fecha de solicitud</div>
                                    <div>
                                        <span :class="'text-secondary'">
                                            <i class="fas fa-calendar-alt"></i>  {{team.fecha_solicitud}}
                                        </span>
                                    </div>	
                                </div>
                                <div class="flex-column text-right pr-1 mr-1" style="border-right: 1px solid #dee2e6 !important;line-height: 1.2;">
                                    <div>Fecha de respuesta</div>
                                    <div>
                                        <span :class="'text-secondary'">
                                            <i class="fas fa-calendar-alt"></i>  {{team.fecha_confirmacion}}
                                        </span>
                                    </div>	
                                </div>
                                <div class="  info-interconsulta-6915  flex-column text-right mr-1" style="line-height: 1.2;">
                                    <div>Tiempo de respuesta</div>	
                                    <div>
                                        <span :class="['text-'+team.color_tiempo_respuesta]">
                                            <i class="fas fa-clock"></i>  {{team.tiempo_respuesta}}
                                        </span>
                                    </div>	
                                </div>
                            
                                <div v-if="!team.answered" class="position-absolute bg-danger" style="line-height: 1.2;line-height: 1.2;
                                  right: 0;
                                  top: 0px;
                                  padding: 0px 5px;
                                  color: white;
                                  font-size: 0.7rem;
                                  border-bottom-left-radius: 10px;"
                                >
                                  <div>No acudió</div>	
                                </div>
                              
                              </div>
                              
                            </li>
                          </template>
                          <template v-else>
                            <li 
                              style="font-weight: 500 !important;"
                              :class="['list-group-item justify-content-center d-flex align-items-center list-group-item-action p-1']"
                            >
                              Sin interconsultas respondidas
                            </li>
                          </template>
                        </ul>
                      </div>

                    </div> 
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" :class="['btn btn-'+currentModalTeam?.color]"  @click="handleCloseModal" >Cerrar</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      `,
    data() {
      return {
        searchQuery: '',
        showingTotal: 0,
        episodios:pacientes_datos,
        episode_id: episodio_id,
        episode: null,
        assignedHealthTeam: [],
        currentModalTeam: null,
        healthTeam: [],
        resumeTeam: [
          {
            siglas: 'TR',
            name: 'Tratante',
            team_id: 1,
            color: 'success',
            system_group_id: [1, 2, 3, 4, 5, 6, 7, 8, 9],
          },
          {
            siglas: 'IN',
            name: 'Interconsultante',
            team_id: 2,
            color: 'info',
            system_group_id: [1, 2, 3, 4, 5, 6, 7, 8, 9],
          },
          {
            siglas: 'FE',
            name: 'Fellow',
            team_id: 3,
            color: 'orange',
            system_group_id: [3, 4],
          },
          {
            siglas: 'RE',
            name: 'Residente',
            team_id: 4,
            color: 'secondary',
            system_group_id: [5, 6, 7, 8],
          },
          {
            siglas: 'RA',
            name: 'RAMH',
            team_id: 5,
            color: 'purple',
            system_group_id: [9],
          },
          {
            siglas: 'EN',
            name: 'Enfermería',
            team_id: 6,
            color: 'warning',
            system_group_id: [10],
          },
        ],
      };
    },
    computed: {
      medicos_paciente() {
        return this.episode?.medico_paciente.filter(
          (x) => x.team_id === this.currentModalTeam?.team_id
        );
      },
      filteredHealthTeam() {
        let result = this.healthTeam
          .map((especiality) => {
            const filteredHealthTeam = especiality.healthTeam.filter((team) =>
              team.medico?.toLowerCase().includes(this.searchQuery.toLowerCase())
            );
            return {
              ...especiality,
              healthTeam: filteredHealthTeam,
            };
          })
          .filter((especiality) => especiality.healthTeam.length > 0);
        this.showingTotal = result.reduce((total, x) => total + x.healthTeam.length, 0);
        return result;
      },
      getLastInterconsultation() {
        if (this.episode?.interconsultation_request) {
          return (this.episode?.interconsultation_request?.filter((x) => !x.fecha_confirmacion))[0]?.medico;
        }

        return '';
      },
    },
    methods: {
      handleCloseModal() {
        $('#healthTeamModal').modal('hide');
      },
      have_active_interconsultation(team) {
        return this.episode?.interconsultation_request
          .map((x) => x.doctor_id)
          .includes(team.user_id);
      },
      is_assigned(team) {
        return this.episode?.medico_paciente
          .some((t) => t.user_id_medico === team.user_id && t.team_id === team.team_id);
      },
      async finishInterconsultation(team, interconsulta_id) {
        let that = this
        Swal.fire({
          title: "¿Completar interconsulta?",
          text: `¿El ${team.medico} acudió a la solicitud de interconsulta?`,
          icon: "info",
          showCancelButton: true,
          confirmButtonColor: "#2fa600",
          cancelButtonColor: "#d33",
          confirmButtonText: "Si",
          showDenyButton: true,
          denyButtonText: "No",
          denyButtonColor: "#3085d6",
          cancelButtonText: "Cancelar"
      }).then( async (result) => {
          if (result.isConfirmed) {
    
            let formdata = new FormData();
            formdata.append("user_id_medico", team.user_id_medico)
            formdata.append("answered", 1)
            formdata.append("episodio_id", this.episode_id)
            formdata.append("_token", $("#_token").val())
            let result = await post(location.origin + "/solicitud_interconsulta/update/"+interconsulta_id, formdata) 
            let index = this.episodios.findIndex(x=>x['episodio'] === this.episode_id)
            this.episodios[index].interconsultation_request = result 
    
            EventBus.$on('externalVarChanged', (newValue) => {
                that.episodios = newValue; 
            });


          }
          if (result.isDenied) {
    
            let formdata = new FormData();
            formdata.append("answered", 0)
            formdata.append("user_id_medico", team.user_id_medico)
            formdata.append("episodio_id", this.episode_id)
            formdata.append("_token", $("#_token").val())
            let result = await post(location.origin + "/solicitud_interconsulta/update/"+interconsulta_id, formdata) 
            let index = this.episodios.findIndex(x=>x['episodio'] === this.episode_id)
            this.episodios[index].interconsultation_request = result 
    
            EventBus.$on('externalVarChanged', (newValue) => {
                that.episodios = newValue; 
            });


          }
      });


      },
      async addInterconsultation(team) {
        let that = this
          Swal.fire({
            title: "Solicitud de interconsulta",
            text: `¿Desea solicitar una interconsulta con el ${team.medico}?`,
            icon: "info",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Aceptar",
            cancelButtonText: "Cancelar"
        }).then( async (result) => {
            if (result.isConfirmed) {
              let interconsultation = that.episode.interconsultation_request.find(
                (x) => x.doctor_id === team.user_id && !x.fecha_confirmacion
              );
              if (interconsultation) {
                alert(`${team.medico} tiene una interconsulta por responder.`);
                return false;
              }
      
              document.querySelector('#loadingScreen').classList.remove('d-none');
              let formdata = new FormData();
              formdata.append("user_id_medico", team.user_id_medico)
              formdata.append("user_id", that.episode.user_id)
              formdata.append("episodio_id", that.episode_id)
              formdata.append("_token", $("#_token").val())
              let result = await post(location.origin + "/solicitud_interconsulta/store", formdata)    
          
              let index = that.episodios.findIndex(x=>x['episodio'] === that.episode_id)
              that.episodios[index].interconsultation_request = result 
      
              EventBus.$on('externalVarChanged', (newValue) => {
                  that.episodios = newValue;
              });
              document.querySelector('#loadingScreen').classList.add('d-none');
      


            }
        });



      },
      async addTeam(team) {
        if (this.is_assigned(team)) {
          alert(`${team.medico} ya está asignado a al paciente.`);
          return false;
        }
       
        document.querySelector('#loadingScreen').classList.remove('d-none');
        let formdata = new FormData();
        formdata.append("user_id_medico", team.user_id)
        formdata.append("episodio_id", this.episode_id)
        formdata.append("user_id_paciente", this.episode.user_id)
        formdata.append("position_id", team.team_id == 2 ? 2 : team.posicion_id)
        formdata.append("_token", $("#_token").val())
        formdata.append("created_at", timestamps())
        let result = await post(location.origin + "/user_cuest_medico_paciente/store", formdata)    
            result.map((x) => {
                if ([1].includes(x.cat_user_medico_posicion_id)) {
                x.team_id = 1;
                }
                if ([2].includes(x.cat_user_medico_posicion_id)) {
                x.team_id = 2;
                }
                if ([3, 4].includes(x.cat_user_medico_posicion_id)) {
                x.team_id = 3;
                }
                if ([5, 6, 7, 8].includes(x.cat_user_medico_posicion_id)) {
                x.team_id = 4;
                }
                if ([9].includes(x.cat_user_medico_posicion_id)) {
                x.team_id = 5;
                }
                if ([10].includes(x.cat_user_medico_posicion_id)) {
                x.team_id = 6;
                }
    
                return x;
            });
            
            this.episode.medico_paciente = result
  
    
            document.querySelector('#loadingScreen').classList.add('d-none');
        ///$('#healthTeamModal').modal('hide')
      },
      async deleteTeam(team) {
        /* medicos_paciente() {
             this.episode?.medico_paciente.filter(
              (x) => x.team_id === this.currentModalTeam?.team_id
            );
          }, */
        document.querySelector('#loadingScreen').classList.remove('d-none');

        let formdata = new FormData();
        formdata.append('id', team.id);
        formdata.append('_token', $('#_token').val());
        formdata.append('created_at', timestamps());
        await post(location.origin + '/user_cuest_medico_paciente/eliminarById', formdata);
        this.episode.medico_paciente = this.episode.medico_paciente.filter(
          (x) => x.id !== team.id
        );
        document.querySelector('#loadingScreen').classList.add('d-none');
      },
      assignTeamGroup(team_id) {
        this.episode?.medico_paciente.map((x) => {
          if ([1].includes(x.cat_user_medico_posicion_id)) {
            x.team_id = 1;
          }
          if ([2].includes(x.cat_user_medico_posicion_id)) {
            x.team_id = 2;
          }
          if ([3, 4].includes(x.cat_user_medico_posicion_id)) {
            x.team_id = 3;
          }
          if ([5, 6, 7, 8].includes(x.cat_user_medico_posicion_id)) {
            x.team_id = 4;
          }
          if ([9].includes(x.cat_user_medico_posicion_id)) {
            x.team_id = 5;
          }
          if ([10].includes(x.cat_user_medico_posicion_id)) {
            x.team_id = 6;
          }

          return x;
        });

        this.currentModalTeam = this.resumeTeam.find((x) => x.team_id === team_id);
        this.healthTeam = this.getHealthTeam(team_id);
        this.searchQuery = '';
      },
      getTeamList(team_id) {
        //console.log('2', this.episode?.medico_paciente);
        this.assignTeamGroup(team_id);

        $('#healthTeamModal').modal('show');
      },

      getLastMedic(team_id) {
        if (this.episode?.medico_paciente) {
  
          return (this.episode?.medico_paciente?.filter((x) => x.team_id === team_id))[
            this.episode?.medico_paciente?.filter((x) => x.team_id === team_id).length - 1
          ];
        }

        return '';
      },
      
      getHealthTeam(team_id) {
        if (team_id === 6) {
          return [
            {
              name: '',
              healthTeam: medicos_datos
                .filter((medic) => {
                  if (medic.posicion_id === 10) {
                    return medic;
                  }
                })
                .map((x) => {
                  x.team_id = team_id;
                  return x;
                }),
            },
          ];
        }

        return Array.from(
          new Set(
            medicos_datos.map((x) => {
              return x.especialidad;
            })
          )
        ).map((especiality) => {
          let team = [];
          if (team_id === 1) {
            team = [1, 2, 3, 4, 5, 6, 7, 8, 9];
          }
          if (team_id === 2) {
            team = [1, 2, 3, 4, 5, 6, 7, 8, 9];
          }
          if (team_id === 3) {
            team = [3, 4];
          }
          if (team_id === 4) {
            team = [5, 6, 7, 8];
          }
          if (team_id === 5) {
            team = [9];
          }
          return {
            name: especiality,
            healthTeam: medicos_datos
              .filter((medic) => {
                return medic.especialidad === especiality && team.includes(medic.posicion_id);
              })
              .map((x) => {
                x.team_id = team_id;
                return x;
              }),
          };
        });
      },
    },
    mounted() {
      this.episode = pacientes_datos.find((x) => x.episodio_id === episodio_id);
      //console.log('1', this.episode);
      [1, 2, 3, 4, 5, 6].forEach((team_id) => {
        this.assignTeamGroup(team_id);
      });

      $('[data-toggle="tooltip"]').tooltip();
    },
  });
};
export default AppResumeHealthTeam;
