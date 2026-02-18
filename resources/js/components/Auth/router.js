export  const routes = [
    {
        name:'Auth',
        path:'/',
        component:()=> import ("./components/Login.vue")
    },
    {
        name:'Auth',
        path:'/auth/equipomedico',
        component:()=> import ("./components/Login.vue")
    },
    {
        name:'Forgot Password',
        path:'/auth/olvidasteContrasena',
        component:()=> import ("./components/ForgotPassword.vue")
    },
    {
        name:'Password Recovery',
        path:'/auth/recuperarcontrasena',
        component:()=> import ("./components/RecoverPassword.vue")
    },
    {
        name:'navegationHome',
        path:'/auth/navegationHome',
        component:()=> import ("./components/NavegacionHome.vue")
    },
    {
        name:'navegationMenu',
        path:'/auth/navegationMenu',
        component:()=> import ("./components/NavegacionMenu.vue")
    },
    {
        name:'Menu principal',
        path:'/auth/menu_inicial_principal',
        component:()=> import ("./components/MenuPrincipal.vue")
    },
    {
        name:'Área quirúrgica',
        path:'/auth/menu_inicial_aq',
        component:()=> import ("./components/MenuAreaQuirurgica.vue")
    },
    {
        name:'Dashboard de Seguimiento',
        path:'/auth/menu_inicial_dashboards',
        component:()=> import ("./components/MenuDashboardsSeguimiento.vue")
    },
    {
        name:'Hospitalización',
        path:'/auth/menu_inicial_hospitalizacion',
        component:()=> import ("./components/MenuHospitalizacion.vue")
    },
    {
        name:'Hospitalización Pisos',
        path:'/auth/menu_inicial_pacientes_piso',
        component:()=> import ("./components/MenuPacientesPiso.vue")
    },
    {
        name:'Uti',
        path:'/auth/menu_inicial_uti',
        component:()=> import ("./components/MenuUti.vue")
    },
    {
        name:'Uti',
        path:'/auth/menu_inicial_satisfaccion',
        component:()=> import ("./components/MenuSatisfaccion.vue")
    },
    {
        name:'Administrador',
        path:'/auth/menu_inicial_administrador',
        component:()=> import ("./components/MenuAdministrador.vue")
    },
    {
        name:'Administrador REPORTES',
        path:'/auth/menu_inicial_administrador_reportes',
        component:()=> import ("./components/MenuAdministradorReportes.vue")
    },
    {
        name:'Eventos Especiales',
        path:'/auth/menu_inicial_eventos_especiales',
        component:()=> import ("./components/MenuEventosEspeciales.vue")
    },


]









