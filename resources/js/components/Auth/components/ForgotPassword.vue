<template>
    <div class="bg-white col-10 col-sm-6 col-md-6 col-lg-4 col-xl-4 text-center p-4 rounded-pill">
        <img class="img-fluid" src="https://patientcare.cmdlt.pstelemed.com/image/system/logo-cmdlt-color.svg"
            style="height: 3.5em;" alt="Not Logo System Found">
        <h4 class=" text-center text-secondary mt-3">Actualizar o recuperar<br>datos de acceso</h4>
        <div class="text-center text-secondary my-3">
            Escribe tu correo electrónico
        </div>

        <form v-on:submit.prevent="procesar();">

            <div class="input-group mb-3">
                <input type="text" name="email" ref="email" autocomplete="off" v-model="form.email"
                    class="form-control" placeholder="Escriba cédula o correo">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
            </div>

            <!-- captcha -->
            <button type="submit" class="btn btn-primary mb-3 w-100">
                Resetear contraseña
            </button>
        </form>
        <router-link class="btn btn-default w-100 font-weight-bold text-secondary" to="/">Regresar</router-link>

    </div>

</template>
<script>
import {is_empty,post} from '../../../helpers/customHelpers.js'
export default{
    name:"ResetPassword",
    data(){
        return{
            form:{
                email:''
            }
        }

    },
    methods: {
        async procesar(){
            if (this.validations()) {
                this.$store.commit('updateProperty', {
                    fieldName:'loading',
                    fieldValue:true,
                });
                let formdata = new FormData();
                    formdata.append("email", this.form.email)
                    formdata.append("_token", document.querySelector('meta[name="csrf-token"]').getAttribute('content') )
                let resultset = await post(location.origin+"/auth/passwordreset/store", formdata)
                    console.log(resultset)
                    if (resultset.status ==="error_send_email") {
                        localStorage.setItem('email', resultset.email);
                        localStorage.setItem('token', resultset.token);

                        Swal.fire({
                            icon: "error",
                            title: "Código de validación no enviado",
                            text: `Ha ocurrido un error al enviar el código de validación a ${resultset.email}. Por favor, comunicarse con el administrador del sistema.`,
                            didClose: () => {
                                window.location.href = '/auth/recuperarcontrasena';
                            }
                        })
                    }
                    if (resultset.status ==="data_not_found") {
                        Swal.fire({
                            icon: "error",
                            title: "Datos incorrectos",
                            text: "El Correo electrónico no es correcto o no está registrado. Verifique.",
                            didClose: () => {
                                setTimeout(() => this.$refs.email.focus(), 110);
                            }
                        })
                        return false
                    }
                    if (resultset.status ==="email_not_found") {
                        Swal.fire({
                            icon: "error",
                            title: "Correo no enviado",
                            text: "Disculpe, ha ocurrido un inconveniente en el envio del código de validación a su correo. Intente nuevamente o pongase en contacto con el administrador del sistema.",
                            didClose: () => {
                                setTimeout(() => this.$refs.email.focus(), 110);
                            }
                        })
                        return false
                    }
                    /* if (resultset.status ==="email_send") {

                        Swal.fire({
                            icon: "success",
                            title: "Contraseña reiniciada",
                            text: `Por favor, verifique el correo ${resultset.email} para obtener el código enviado.`,
                        })
                    } */
                    if (resultset.status) {
                        Swal.fire({
                            icon: "success",
                            title: "Contraseña reiniciada",
                            text: `Por favor, verifique el correo ${resultset.email} para obtener el código enviado.`,
                        })
                        localStorage.setItem('email', resultset.email);
                        localStorage.setItem('token', resultset.token);
                        window.location.href = '/auth/recuperarcontrasena';
                    }
                    this.$store.commit('updateProperty', {
                        fieldName:'loading',
                        fieldValue:false,
                    });
                    
            }
        },
        validations(){
            if( is_empty(this.form.email) ){
                Swal.fire({
                    icon: "warning",
                    title: "Campo vacio",
                    text: "Por favor, escribe una cédula o correo electrónico válido.",
                    didClose: () => {
                        setTimeout(() => this.$refs.email.focus(), 110);
                    }
                })
                return false
            }
            return true
        }
    },
    mounted() {
        this.$store.commit('updateProperty', {
            fieldName:'loading',
            fieldValue:false,
        });
    },
}
</script>

