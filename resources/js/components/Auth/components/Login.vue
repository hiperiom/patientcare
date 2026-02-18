<template>
    <div class="d-flex flex-column align-items-center justify-content-center bg-white p-4 text-center rounded-pill">
        <div class="px-0 px-sm-5">


            <img class="img-fluid" src="https://patientcare.cmdlt.pstelemed.com/image/system/logo-cmdlt-color.svg"
                style="height: 3.5em;" alt="Not Logo System Found">
            <h4 class=" text-center text-secondary mt-3">¡Bienvenido!</h4>
            <div class="text-center text-secondary my-3">
                Autenticate para iniciar sesión
            </div>

            <form ref="form" v-on:submit.prevent="procesar();">
                <div class="input-group mb-3">
                    <input type="text" name="email" ref="email" autocomplete="off" v-model="form.email" title="Debe ingresar una Cédula Correo Electrónico valido"
                        class="form-control" placeholder="Escriba cédula o correo">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input :type="passwordInput" ref="password" title="Debe ingresar una contraseña valida" name="password" v-model="form.password"
                        class="form-control" placeholder="Escriba contraseña">
                    <div class="input-group-append">
                        <div class="input-group-text" @click="togglePasswordVisibility()">
                            <span :class="['far cursor-pointer',passwordIcon]"></span>
                        </div>
                    </div>
                </div>
                <!-- captcha -->
                <button type="submit" class="btn btn-primary mb-3 w-100">
                    Iniciar Sesión
                </button>
            </form>

            <router-link class=" w-100 font-weight-bold text-secondary" to="/auth/olvidasteContrasena">Actualizar o recuperar datos de acceso</router-link>
        </div>

    </div>

</template>
<script>
import { is_undefined } from '../../../helpers/customHelpers.js';
import {is_empty,post} from '../../../helpers/customHelpers.js'
export default{
    name:"AuthEspecialista",
    data(){
        return{
            passwordInput:"password",
            passwordIcon:"fa-eye",
            form:{
                email:'',
                password:'',
            }
        }

    },
    methods: {
        togglePasswordVisibility() {

            if (this.passwordInput === "password") {
                this.passwordInput= "text";
                this.passwordIcon= "fa-eye-slash";
            } else {
                this.passwordInput = "password";
                this.passwordIcon= "fa-eye";
            }
        },

        async procesar(){
            if (this.validations()) {
                this.$store.commit('updateProperty', {
                    fieldName:'loading',
                    fieldValue:true,
                });
                let formdata = new FormData();
                    formdata.append("email", this.form.email)
                    formdata.append("password", this.form.password)
                    formdata.append("_token", document.querySelector('meta[name="csrf-token"]').getAttribute('content') )
                    let resultset = await post(location.origin+"/auth/validateUser", formdata)
                        console.log("--->",resultset)
                        if(resultset){
                            this.$store.commit('updateProperty', {
                                fieldName:'id',
                                fieldValue:resultset.data.user_id,
                            });

                            if (resultset) {
                                localStorage.setItem("user_profile",JSON.stringify(resultset.data))
                                this.$store.commit('updateProperty', {
                                    fieldName:'loading',
                                    fieldValue:false,
                                });
                                let showMenu = true;
                                    //INICIO VALIDACION DE ENRUTAMIENTO POR TIPO DE USUARIO
                                    //INICIO RUTAS PARA TABLEROS PISOS HOSPITALIZACION
                                    if(Number(resultset.data.user_id) ===20056){
                                        let user_id = resultset.data.user_id
                                            location.href = location.origin + "/auth/areahospitalizacion?user_id="+user_id+"&piso=3&ala=a"
                                        showMenu = false
                                    }
                                    if(Number(resultset.data.user_id) ===20057){
                                        let user_id = resultset.data.user_id
                                            location.href = location.origin + "/auth/areahospitalizacion?user_id="+user_id+"&piso=3&ala=b"
                                        showMenu = false
                                    }
                                    if(Number(resultset.data.user_id) ===20058){
                                        let user_id = resultset.data.user_id
                                            location.href = location.origin + "/auth/areahospitalizacion?user_id="+user_id+"&piso=5&ala=a"
                                        showMenu = false
                                    }
                                    if(Number(resultset.data.user_id) ===20059){
                                        let user_id = resultset.data.user_id
                                            location.href = location.origin + "/auth/areahospitalizacion?user_id="+user_id+"&piso=5&ala=b"
                                        showMenu = false
                                    }
                                    if(Number(resultset.data.user_id) ===20060){
                                        let user_id = resultset.data.user_id
                                            location.href = location.origin + "/auth/areahospitalizacion?user_id="+user_id+"&piso=6&ala=a"
                                        showMenu = false
                                    }
                                    //FIN RUTAS PARA TABLEROS PISOS HOSPITALIZACION
                                    //FIN VALIDACION DE ENRUTAMIENTO POR TIPO DE USUARIO
                                /* this.$store.commit('updateProperty', {
                                    fieldName:'user_profile',
                                    fieldValue:resultset.data,
                                }); */
                                //window.location.href = '/auth/redirectEspecialista';
                                //let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']


                                let user_admin_id = [
                                    22,//parodi
                                    2501,//teresa
                                    102,//kim
                                ]
                                let tempMenu = this.$store.state.navegationMenu
                                    if(user_admin_id.includes(this.$store.state.id)){
                                        tempMenu.navegationHome.menu = tempMenu.navegationHome.menu
                                    }else{
                                        tempMenu.navegationHome.menu = tempMenu.navegationHome.menu.filter(x=>![7].includes(x.id))
                                    }
                                    this.$store.commit('updateProperty', {
                                        fieldName:'navegationMenu',
                                        fieldValue: tempMenu,
                                    });


                                    if (showMenu) {
                                        localStorage.setItem("currentNavegationMenu","navegationHome")
                                        // this.$router.push("/auth/navegationHome");
                                        window.location.href = window.origin+"/auth/menu_inicial_principal";
                                    }

                                    //this.$router.push({ name: 'navegacionlv0', params: { id: 'navegationLV0' }});
                                    //location.href = location.origin + '/auth/navegacionlv0';
                            }else{
                                localStorage.removeItem("user_profile")
                                this.$store.commit('updateProperty', {
                                    fieldName:'loading',
                                    fieldValue:false,
                                });
                                Swal.fire({
                                    icon: "error",
                                    title: "Datos incorrectos",
                                    text: "Los datos no son correctos o no están registrados. Verifique.",
                                    didClose: () => {
                                        setTimeout(() => this.$refs.email.focus(), 110);
                                    }
                                })
                                return false
                            }
                        }else{
                            Swal.fire({
                                icon: "error",
                                title: "Datos incorrectos",
                                text: `Los datos de acceso no son correctos o no están registrados.`,
                                didClose: () => {
                                    this.form.email = ""
                                    this.form.password = ""
                                }
                            })
                        }

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
<style>
.bg-white, .bg-white>a {
    color: var(--secondary) !important;
}
</style>

