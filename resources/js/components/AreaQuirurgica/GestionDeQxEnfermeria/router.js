export  const routes = [

    {
        name:'Plan quirúrgico Programado',
        path:'/areaQuirofano/enfermeria/index_enfermeria',
        component:()=> import ("./components/IndexQuirofano/Index.vue")
    },
    {
        name:'Plan quirúrgico Ejecutado',
        path:'/areaQuirofano/enfermeria/index_finalizadas',
        component:()=> import ("./components/IndexQuirofano/Index.vue")
    },
  
    
]









