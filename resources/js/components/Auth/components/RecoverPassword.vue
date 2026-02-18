<template>
    <div class="bg-white col-10 col-sm-6 col-md-6 col-lg-4 col-xl-4 text-center p-4 rounded-pill">
        <img class="img-fluid" src="https://patientcare.cmdlt.pstelemed.com/image/system/logo-cmdlt-color.svg"
            style="height: 3.5em;" alt="Not Logo System Found">
        <h4 class=" text-center text-secondary mt-3">Actualizar tus<br>datos de acceso</h4>
        <div class="text-center text-secondary my-3">
            Escribe y confirma tu nueva contraseña, conjuntamente con el código enviado al correo: <b>{{email}}</b>
        </div>

        <form v-on:submit.prevent="procesar();">

            <div class="input-group mb-3">
                <input type="password" ref="password" name="password" v-model="form.password"
                    class="form-control" placeholder="Nueva contraseña">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>
            <div class="input-group mb-3">
                <input type="password" ref="re_password" name="re_password" v-model="form.re_password"
                    class="form-control" placeholder="Repita Nueva contraseña">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>
            <div class="input-group mb-3">
                <input type="text" name="token" ref="token" autocomplete="off" v-model="form.token" 
                    class="form-control" placeholder="Código recibido">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
            </div>

            <!-- captcha -->
            <button type="submit" class="btn btn-primary mb-3 w-100">
                Confirmar nuevos datos
            </button>
        </form>
        <router-link class="btn btn-default w-100 font-weight-bold text-secondary" to="/auth/olvidasteContrasena">Regresar</router-link>
        <span class="text-white">{{getToken}}</span>
    </div>

</template>
<script>
import {is_empty,post} from '../../../helpers/customHelpers.js'
export default{
    name:"RecoverPassword",
    data(){
        return{
            form:{
                email: localStorage.getItem('email'),
                password:'',
                re_password:'',
                token_ls: localStorage.getItem('token'),
                token: '',
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
                    formdata.append("password", this.form.password)
                    formdata.append("password_token", this.form.token)
                    formdata.append("_token", document.querySelector('meta[name="csrf-token"]').getAttribute('content') )
                    let resultset = await post(location.origin+"/auth/passwordreset/storeconfirm", formdata)
                        console.log(resultset)

                        this.$store.commit('updateProperty', {
                            fieldName:'loading',
                            fieldValue:false,
                        });
                        if (resultset.status) {
                            localStorage.removeItem('email');
                            localStorage.removeItem('token');
                            Swal.fire({
                                icon: "success",
                                title: "Contraseña Actualizada",
                                text: `Los datos de acceso han sido actualizado.`,
                                didClose: () => {
                                    setTimeout(() => window.location.href = '/auth/equipomedico', 110);
                                }
                            })
                        }    
            }
        },
        validations(){
            if( is_empty(this.form.password) ){
                Swal.fire({
                    icon: "warning",
                    title: "Campo vacio",
                    text: "Por favor, escribe una contraseña válida.",
                    didClose: () => {
                        setTimeout(() => this.$refs.password.focus(), 110);
                    }
                })
                return false
            }
            if( is_empty(this.form.password) ){
                Swal.fire({
                    icon: "warning",
                    title: "Campo vacio",
                    text: "Por favor, repite la nueva contraseña válida.",
                    didClose: () => {
                        setTimeout(() => this.$refs.password.focus(), 110);
                    }
                })
                return false
            }
            if( this.form.password !== this.form.re_password ){
                Swal.fire({
                    icon: "warning",
                    title: "Campo vacio",
                    text: "Por favor, verifica que las contraseñas sean iguales.",
                    didClose: () => {
                        setTimeout(() => this.$refs.password.focus(), 110);
                    }
                })
                return false
            }
            if( is_empty(this.form.token) ){
                Swal.fire({
                    icon: "warning",
                    title: "Campo vacio",
                    text: "Por favor, escribe el código enviado a tu correo.",
                    didClose: () => {
                        setTimeout(() => this.$refs.token.focus(), 110);
                    }
                })
                return false
            }
            if( this.form.token !== this.form.token_ls ){
                Swal.fire({
                    icon: "warning",
                    title: "Código incorrecto",
                    text: "Disculpe, el código escrito no coincide con el enviado a su correo.",
                    didClose: () => {
                        setTimeout(() => this.$refs.token.focus(), 110);
                    }
                })
                return false
            }
            return true
        }
    },
    computed:{
        getToken(){
            return localStorage.getItem('token')
        },
        email(){
            return localStorage.getItem('email')
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

