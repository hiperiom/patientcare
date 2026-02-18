export  const routes = [

    {
        name:'Plan quirúrgico',
        path:'/areaQuirofano/externo/iqx',
        component:()=> import ("./components/Index.vue")
    },
    {
        name:'Plan quirúrgico Hospitalización',
        path:'/areaQuirofano/externo/iqx_hosp',
        component:()=> import ("./components/Index_hospitalizacion.vue")
    },
    {
        name:'Plan quirúrgico Ambulatorio',
        path:'/areaQuirofano/externo/iqx_amb',
        component:()=> import ("./components/Index_ambulatorio.vue")
    },
  
    
]









