let origin = '/user/admin'
export  const routes = [
    {
        name:'Inicio',
        path: origin + '/index',
        component:()=> import ("./components/Inicio.vue")
    },
    {
        name:'Pacientes',
        path: origin + '/paciente',
        component:()=> import ("./components/Pacientes.vue")
    },
    {
        name:'Equipo de Salud',
        path: origin + '/equiposalud',
        component:()=> import ("./components/EquipoSalud.vue")
    },
    {
        name:'Gestión de usuarios',
        path: origin + '/gestion_usuarios',
        component:()=> import ("./components/GestionUsuarios.vue")
    },
    {
        name:'Reportes',
        path: origin + '/gestion_reportes',
        component:()=> import ("./components/GestionReportes.vue")
    },
    /* {
        name:'Encuestas',
        path: origin + '/gestion_encuestas',
        component:()=> import ("./components/GestionReportes.vue")
    }, */
    
]









