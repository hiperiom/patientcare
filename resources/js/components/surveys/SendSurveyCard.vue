<template>
    <div class="col-12 col-sm-6 col-lg-4 col-xl-3 col-xxl-2 py-1 d-flex">
        <div class="col-12 rounded-xl"
            :class="{
                'bg-light-danger':  discharged.status === 0 || discharged.status === 9 ? true : false,
                'bg-light-warning': discharged.status === 1 ? true : false,
                'bg-light-success': discharged.status === 2 ? true : false,
            }"
            >
            <div class="row">
                <span v-if="discharged.status === 0 || discharged.status === 9" class="esquina-superior-derecha text-secondary">
                    <i v-if="discharged.status === 0 " class="fas fa-eye-slash icono-mano" @click="hideShowCard(discharged.id, 9)"></i>
                    <i v-if="discharged.status === 9 " class="fas fa-eye icono-mano" @click="hideShowCard(discharged.id, 0)"></i>
                </span>
                <div class="col-3 big-icon">
                    <i :class="big_icon"></i>
                </div>
                <div class="col-9 text-center align-self-center text-secondary">
                    <!-- <span class="ubicacion" v-if="discharged.episodio.ubicacion">{{discharged.episodio.ubicacion.description}} | {{ discharged.episodio.ubicacion.coments }}</span> -->
                    <span class="ubicacion" v-if="discharged.ubicacion !== null">{{discharged.ubicacion}}</span>
                    <span class="ubicacion" v-else-if="discharged.episodio.ubicacion">{{discharged.episodio.ubicacion.description}} | {{ discharged.episodio.ubicacion.coments }}</span>
                    <span class="ubicacion" v-else>Sin ubicación</span>
                    <span v-if="discharged.sent_insitu === 2">
                        <i
                            class="fas fa-check-double text-success tooltip-primary text-secondary"
                            data-toggle="tooltip"
                            title="Encuesta contestada en la habitación">
                        </i>
                    </span>
                    <span v-else-if="discharged.sent_insitu === 1">
                        <i
                            class="fas fa-check text-success tooltip-primary text-secondary"
                            data-toggle="tooltip"
                            title="Encuesta enviada en la habitación">
                        </i>
                    </span>
                </div>
            </div>
            <hr class="dropdown-divider">
            <div class="row">
                <div class="col-12 name">
                    {{ discharged.episodio.paciente.profile.nombres }} {{ discharged.episodio.paciente.profile.apellidos }}
                </div>
            </div>
            <hr class="dropdown-divider">
            <div class="row band-gray">
                <div class="d-flex justify-content-between">
                    <div class="align-self-center">
                        <i class="far fa-envelope medium-icon text-secondary"></i>
                    </div>
                    <div class="align-self-center flex-fill ml-2 text-secondary">
                        <span>{{ discharged.episodio.paciente.email }}</span>
                    </div>
                    <div class="flex-column">
                        <div class="">
                            <i v-show="discharged.sent_email === 0"
                                class="far fa-edit icono-mano tooltip-primary text-secondary"
                                @click="updateEmail(discharged.episodio.paciente.id,discharged.episodio.paciente.email)"
                                data-toggle="tooltip"
                                title="Editar email"
                            ></i>

                            <i v-show="discharged.sent_email === 1"
                                class="fas fa-undo icono-mano tooltip-primary text-secondary"
                                @click="rollbackEmail(discharged.id)"
                                data-toggle="tooltip"
                                title="Deshacer envío por email">
                            </i>
                            <i v-show="discharged.sent_email === 2" class="far fa-smile-beam text-secondary"></i>
                        </div>
                        <div class="">
                            <i v-show="discharged.sent_email === 0"
                                class="fas fa-times text-danger tooltip-primary text-secondary"
                                data-toggle="tooltip"
                                title="Encuesta sin enviar vía email">
                            </i>
                            <i v-show="discharged.sent_email === 1"
                                class="fas fa-check text-success tooltip-primary text-secondary"
                                data-toggle="tooltip"
                                title="Encuesta enviada vía email">
                            </i>
                            <i v-show="discharged.sent_email === 2"
                                class="fas fa-check-double text-success tooltip-primary text-secondary"
                                data-toggle="tooltip"
                                title="Encuesta contestada vía email">
                            </i>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="dropdown-divider">
            <div class="row band-gray">
                <div class="d-flex justify-content-between">
                    <div class="align-self-center">
                        <i class="fab fa-whatsapp medium-icon text-success"></i>
                    </div>
                    <div class="align-self-center flex-fill ml-2 text-secondary">
                        <span>{{ discharged.episodio.paciente.profile.telefono_movil }}</span>
                    </div>
                    <div class="flex-column">
                        <div class="">
                            <i v-show="discharged.sent_whatsapp === 0"
                                class="far fa-edit icono-mano tooltip-primary text-secondary"
                                @click="updateWhatsapp(discharged.episodio.paciente.profile.id,discharged.episodio.paciente.profile.telefono_movil)"
                                data-toggle="tooltip"
                                title="Editar whatsapp">
                            </i>
                            <i v-show="discharged.sent_whatsapp === 1"
                                class="fas fa-undo icono-mano tooltip-primary text-secondary"
                                @click="rollbackWhatsapp(discharged.id)"
                                data-toggle="tooltip"
                                title="Deshacer envío por whatsapp">
                            </i>
                            <i v-show="discharged.sent_whatsapp === 2" class="far fa-smile-beam text-secondary"></i>
                        </div>
                        <div class="">
                            <i v-show="discharged.sent_whatsapp === 0"
                                class="fas fa-times text-danger tooltip-primary text-secondary"
                                data-toggle="tooltip"
                                title="Encuesta sin enviar vía whatsapp">
                            </i>
                            <i v-show="discharged.sent_whatsapp === 1"
                                class="fas fa-check text-success tooltip-primary text-secondary"
                                data-toggle="tooltip"
                                title="Encuesta enviada vía whatsapp">
                            </i>
                            <i v-show="discharged.sent_whatsapp === 2"
                                class="fas fa-check-double text-success tooltip-primary text-secondary"
                                data-toggle="tooltip"
                                title="Encuesta contestada vía whatsapp">
                            </i>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="dropdown-divider">
            <div class="row" :class="{'pb-1': discharged.status === 2 ? true : false}">
                <div class="col-12 text-center text-secondary">
                    <small>Fecha del alta | {{new Date(discharged.egress_date).toLocaleDateString('es-VE')}}</small>
                </div>
            </div>
            <div class="row align-items-end" v-if="discharged.status !== 2">
                <button
                    type="button"
                    class="btn btn-flat btn-block buttom-rounded-xl"
                    :class="{
                        'btn-primary': botonBloqueado(discharged) ? false : true,
                        'btn-secondary': botonBloqueado(discharged) ? true : false,
                    }"
                    :disabled="botonBloqueado(discharged)"
                    @click="send_survey(discharged)"
                >
                   <span v-show="!botonBloqueado(discharged)">Enviar encuesta <i class="far fa-paper-plane"></i></span>
                   <span v-show="botonBloqueado(discharged)">Encuesta enviada por ambas vías.</span>
                </button>
            </div>
        </div>
    </div>

</template>

<script>
import {phone} from 'phone';
export default {
    props: ["discharged","big_icon","send_survey","update_send_survey_list"],
    data() {
        return {
        };
    },

    methods: {
        botonBloqueado(discharged){
            return (discharged.sent_email !== 0 && discharged.sent_whatsapp !== 0) ? true : false
        },
        hideShowCard(discharged_id, newStatus){
            let title = '¿Estás seguro de activarlo?'
            let text = 'será movido a la pestaña de por enviar, podrá devolver la acción más adelante.'
            if(newStatus === 9){
                title = '¿Estás seguro de descartarlo?'
                text = 'será movido a la pestaña de no enviados, podrá devolver la acción más adelante.'
            }
            Swal.fire({
                    title: title,
                    text: text,
                    icon: 'warning',
                    showCancelButton: true,
                    cancelButtonText: 'Cancelar',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí',
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('loadingScreen').classList.remove("d-none")
                        axios.post(window.location.origin+"/updateDischargerStatus", {
                            discharged_id: discharged_id,
                            newStatus: newStatus,
                        }).then(res => {
                            this.update_send_survey_list()
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: res.data,
                                showConfirmButton: false,
                                timer: 2500
                            })
                        }).catch(error => {
                            Swal.showValidationMessage(
                            `Hubo algún error, inténtalo nuevamente...`
                            )
                        })
                    }
                })
        },
        updateEmail(user_id, email){
            Swal.fire({
                icon: 'warning',
                title: 'Edita el correo electrónico...',
                input: 'text',
                inputValue: email,
                inputAttributes: {
                    autocapitalize: 'off'
                },
                cancelButtonText: 'Cancelar',
                cancelButtonColor: '#d33',
                showCancelButton: true,
                confirmButtonText: 'Editar',
                confirmButtonColor: '#3085d6',
                showLoaderOnConfirm: true,
                preConfirm: (email) => {
                    document.getElementById('loadingScreen').classList.remove("d-none")
                    axios.post(window.location.origin+"/updateEmail", {
                        user_id: user_id,
                        newEmail: email,
                    }).then(res => {
                        if(res.data === 'El correo electrónico fue modificado con éxito.'){
                            var icono = 'success';
                        }else{
                            var icono = 'error';
                        }
                        this.update_send_survey_list()
                        Swal.fire({
                            position: 'top-end',
                            icon: icono,
                            title: res.data,
                            showConfirmButton: false,
                            timer: 2500
                        })
                    }).catch(error => {
                        Swal.showValidationMessage(
                        `Hubo algún error, inténtalo nuevamente...`
                        )
                    })
                },
                allowOutsideClick: () => !Swal.isLoading()
            })
        },
        updateWhatsapp(profile_id, whatsapp){
            Swal.fire({
                icon: 'warning',
                title: 'Edita el whatsapp...',
                inputLabel: 'debe tener el siguiente formato +(Código de país) Número de teléfono',
                input: 'text',
                inputValue: whatsapp,
                inputAttributes: {
                    autocapitalize: 'off',
                },
                cancelButtonText: 'Cancelar',
                cancelButtonColor: '#d33',
                showCancelButton: true,
                confirmButtonText: 'Editar',
                confirmButtonColor: '#3085d6',
                showLoaderOnConfirm: true,
                preConfirm: (whatsapp) => {
                    console.log(phone(whatsapp))
                    // if(whatsapp.substring(0,4) === '+584' && whatsapp.length === 13){
                    if (phone(whatsapp).isValid) {
                        document.getElementById('loadingScreen').classList.remove("d-none")
                        axios.post(window.location.origin+"/updateWhatsapp", {
                            profile_id: profile_id,
                            newWhatsapp: phone(whatsapp).phoneNumber,
                        }).then(res => {
                            if(res.data === 'El número de whatsapp fue modificado con éxito.'){
                                var icono = 'success';
                            }else{
                                var icono = 'error';
                            }
                            this.update_send_survey_list()
                            Swal.fire({
                                position: 'top-end',
                                icon: icono,
                                title: res.data,
                                showConfirmButton: false,
                                timer: 2500
                            })
                        }).catch(error => {
                            Swal.showValidationMessage(
                            `Hubo algún error, inténtalo nuevamente...`
                            )
                        })
                    }else{
                        Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                title: 'El formato del whatsapp es incorrecto!',
                                showConfirmButton: false,
                                timer: 2500
                            })
                    }
                },
                allowOutsideClick: () => !Swal.isLoading()
            })
        },
        rollbackEmail(dischargedId){
            Swal.fire({
                icon: 'warning',
                title: '¿Quiere cambiar el estatus a correo no enviado?',
                inputLabel: 'Por favor justifique el motivo por el cual quiere revertir el estatus.',
                input: 'text',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                cancelButtonText: 'Cancelar',
                cancelButtonColor: '#d33',
                showCancelButton: true,
                confirmButtonText: 'Cambiar',
                confirmButtonColor: '#3085d6',
                showLoaderOnConfirm: true,
                preConfirm: (motivo) => {
                    document.getElementById('loadingScreen').classList.remove("d-none")
                    axios.post(window.location.origin+"/dischargeds/rollbackEmail", {
                        id: dischargedId,
                        motivo: motivo,
                    }).then(res => {
                        this.update_send_survey_list()
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: res.data,
                            showConfirmButton: false,
                            timer: 2500
                        })
                    }).catch(error => {
                        Swal.showValidationMessage(
                        `Hubo algún error, inténtalo nuevamente...`
                        )
                    })
                },
                allowOutsideClick: () => !Swal.isLoading()
            })
        },
        rollbackWhatsapp(dischargedId){
            Swal.fire({
                icon: 'warning',
                title: '¿Quiere cambiar el estatus a whatsapp no enviado?',
                inputLabel: 'Por favor justifique el motivo por el cual quiere revertir el estatus.',
                input: 'text',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                cancelButtonText: 'Cancelar',
                cancelButtonColor: '#d33',
                showCancelButton: true,
                confirmButtonText: 'Cambiar',
                confirmButtonColor: '#3085d6',
                showLoaderOnConfirm: true,
                preConfirm: (motivo) => {
                    document.getElementById('loadingScreen').classList.remove("d-none")
                    axios.post(window.location.origin+"/dischargeds/rollbackWhatsapp", {
                        id: dischargedId,
                        motivo: motivo,
                    }).then(res => {
                        this.update_send_survey_list()
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: res.data,
                            showConfirmButton: false,
                            timer: 2500
                        })
                    }).catch(error => {
                        Swal.showValidationMessage(
                        `Hubo algún error, inténtalo nuevamente...`
                        )
                    })
                },
                allowOutsideClick: () => !Swal.isLoading()
            })
        }
    },
    mounted() {
        $(document).ready(function () {
            $('[data-toggle="tooltip"].tooltip-primary').tooltip({customClass:'tooltip-primary'})
            // $('[data-toggle="tooltip"].tooltip-warning').tooltip({customClass:'tooltip-warning'})
            // $('[data-toggle="tooltip"].tooltip-danger').tooltip({customClass:'tooltip-danger'})
            // $('[data-toggle="tooltip"].tooltip-secondary').tooltip({customClass:'tooltip-secondary'})
            // $('[data-toggle="tooltip"].tooltip-info').tooltip({customClass:'tooltip-info'})
            // $('[data-toggle="tooltip"].tooltip-success').tooltip({customClass:'tooltip-success'})
        });
    },
};
</script>
<style scoped>
.band-gray {
    background-color:rgb(0,0,0,0.1) !important ;
}
.bg-light-success {
    background-color:rgb(0,0,0,0.05) !important ;
    border-left: solid;
    border-left-width: 0.5rem;
    border-left-color: var(--green);
}
.bg-light-warning {
    background-color:rgb(0,0,0,0.05) !important ;
    border-left: solid;
    border-left-width: 0.5rem;
    border-left-color: darkorange;
}
.bg-light-danger {
    background-color:rgb(0,0,0,0.05) !important ;
    border-left: solid;
    border-left-width: 0.5rem;
    border-left-color: rgb(255,0,0);
}
.big-icon {
    font-size: 2.5em;
    text-align: right;
    color: var(--primary);
}

.medium-icon {
    font-size: 2em;
}
.ubicacion {
    font-size: 1em;
    text-align: center;
}
.name {
    font-size: 1em;
    font-weight: bold;
    text-align: center;
    color: var(--secondary);
}
.rounded-xl {
    border-radius: 1.5rem;
    /* border-radius: 10% / 50%; */
    /* min-height: 310px; */
}
.buttom-rounded-xl{
    /* background-color: rgb(0,0,0,0.15) !important; */
    border-bottom-left-radius: 1.5rem;
    border-bottom-right-radius: 1.5rem;
}
.esquina-superior-derecha {
    position: relative;
    top: 20px; left: 85%;
    z-index:10000;
}
.icono-mano:hover {
  cursor: pointer;
}

</style>
