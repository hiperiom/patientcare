export  const routes = [
    {
        name:'Nueva programación',
        path:'/areaQuirofano/create_quirofano',
        component:()=> import ("./components/Create_quirofano.vue")
    },
     {
        name:'Editar programación',
        path:'/areaQuirofano/edit_quirofano',
        component:()=> import ("./components/Edit_quirofano.vue")
    },
    {
        name:'Plan quirúrgico Programado',
        path:'/areaQuirofano/index_quirofano',
        component:()=> import ("./components/IndexQuirofano/Index.vue")
    },
    {
        name:'Plan quirúrgico Ejecutado',
        path:'/areaQuirofano/index_finalizadas',
        component:()=> import ("./components/IndexQuirofano/Index.vue")
    },

    /*  {
        name:'/Recuperar Contraseña',
        path:'/auth/recuperarContrasena',
        component:()=> import ("./components/Auth/components/RecoverPassword.vue")
    },
    {
        name:'/Area Especialistas',
        path:'/medico',
        component:()=> import ("./components/Auth/components/LoginEspecialista.vue")
    },
    {
        name:'/Opciones de Ingreso',
        path:'/auth/accessUserProfile',
        component:()=> import ("./components/Auth/components/AccessUserProfile.vue")
    }, */

]









