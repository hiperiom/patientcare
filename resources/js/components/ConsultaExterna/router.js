export  const routes = [
    /* {
        name:'Listado de citas',
        path:'/consultaexterna/app/citalistado',
        component:()=> import ("./components/CitaIndex.vue")
    }, */
    {
        name:'Crear Cita',
        path:'/consultaexterna/app/citacreate',
        component:()=> import ("./components/CitaCreate.vue")
    },
    {
        name:'Nuevo Paciente',
        path:'/consultaexterna/app/pacientecreate',
        component:()=> import ("./components/PacienteCreate.vue")
    },
    {
        name:'Buscar Paciente',
        path:'/consultaexterna/app/pacientebuscar',
        component:()=> import ("./components/PacienteBuscar.vue")
    },
    {
        name:'Listado de citas',
        path:'/consultaexterna/app/citalistado',
        component:()=> import ("./components/CitaIndex.vue"),
        children: [
            {
                name:'Citas por confirmar',
                path:'/consultaexterna/app/citalistado/porconfirmar',
                component:()=> import ("./components/CitasPorConfirmar.vue")
            },
            {
                name:'Citas confirmadas',
                path:'/consultaexterna/app/citalistado/confirmadas',
                component:()=> import ("./components/CitasConfirmadas.vue")
            },
            {
                name:'Citas en preconsulta',
                path:'/consultaexterna/app/citalistado/preconsulta',
                component:()=> import ("./components/CitasPreconsulta.vue")
            },
            {
                name:'Citas en consulta',
                path:'/consultaexterna/app/citalistado/consulta',
                component:()=> import ("./components/CitasConsulta.vue")
            },
          
        ]
    },
    
    


]









