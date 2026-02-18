export  const routes = [

    {
        name:'Plan quirúrgico',
        path:'/areaQuirofanoAmb/externo/iqx',
        component:()=> import ("./components/Index.vue")
    },
    {
        name:'Plan quirúrgico Hospitalización',
        path:'/areaQuirofanoAmb/externo/iqx_hosp',
        component:()=> import ("./components/Index_hospitalizacion.vue")
    },
    {
        name:'Plan quirúrgico Ambulatorio',
        path:'/areaQuirofanoAmb/externo/iqx_amb',
        component:()=> import ("./components/Index_ambulatorio.vue")
    },


]









