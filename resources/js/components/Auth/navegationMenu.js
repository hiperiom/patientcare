let menu_id = 0

export  const navegationMenu = {
    navegationHome:{
        goback:{
            title:"",
            icon:"",
            route:"",
            eventHandle(){
                 /*  let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']
                    route = location.origin + "/medico"+ "?user_id="+user_id
                    this.$router.push(route); */
            },
            active:true,
        },
        menu:[
            {
                id: 1,
                title:"Seguimiento de Pacientes",
                icon:"pc-paciente",
                eventHandle: function(e){
                    /* localStorage.setItem("currentNavegationMenu","navegationLv0_1")
                    return {
                        type: 'route',
                        value: '/auth/navegationMenu'
                    } */
                    return {
                        type: 'function',
                        value: ()=>{
                            let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']
                            location.href = location.origin + "/auth/areaequiposalud?user_id="+user_id
                        }
                       /*  value: ()=>{
                            //alert("Acceso no disponible")
                            let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']
                                location.href = location.origin + "/auth/areaequipoEnfermeria?user_id="+user_id
                        } */
                    }
                },
                active:true,
            },
            {
                id: 2,
                title:"Resumen Clínico",
                icon:"pc-resumen_clinico",
                eventHandle: function(e){
                    /* localStorage.setItem("currentNavegationMenu","navegationLv0_1")
                    return {
                        type: 'route',
                        value: '/auth/navegationMenu'
                    } */
                    return {
                        type: 'function',
                        value: ()=>{
                            let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']
                            location.href = location.origin + "/auth/arearesumenclinico?user_id="+user_id
                        }
                    }
                },
                active:true,
            },
            {
                id: 3,
                title:"Área Quirúrgica",
                icon:"pc-cirugia-light",
                eventHandle(){
                    return {
                        type: 'function',
                        value: ()=>{
                            let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']
                                location.href = location.origin + "/auth/areaquirurgica?user_id="+user_id
                        }
                    }
                    /* return {
                        type: 'function',
                        value: (that)=>{
                            localStorage.setItem("currentNavegationMenu","navegationLv0_1_emergencia")
                            that.currentNavegationMenu = localStorage.getItem("currentNavegationMenu")
                        }
                    } */

                },
                active:true,
            },
            {
                id: 3,
                title:"Área Quirúrgica MAPM",
                icon:"pc-cirugia-light",
                eventHandle(){
                    return {
                        type: 'function',
                        value: ()=>{
                            let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']
                                location.href = location.origin + "/auth/areaquirurgicaamb?user_id="+user_id
                        }
                    }
                    /* return {
                        type: 'function',
                        value: (that)=>{
                            localStorage.setItem("currentNavegationMenu","navegationLv0_1_emergencia")
                            that.currentNavegationMenu = localStorage.getItem("currentNavegationMenu")
                        }
                    } */

                },
                active:true,
            },
            {
                id: 4,
                title:"Telesalud",
                icon:"pc-telesalud",
                eventHandle: function(e){
                    localStorage.setItem("currentNavegationMenu","navegationLv0_1_telesalud")
                    return {
                        type: 'route',
                        value: '/auth/navegationMenu'
                    }
                },
                active:true,
            },
            {
                id: 5,
                title:"Dashboards de Seguimiento",
                icon:"pc-tablero",
                eventHandle: function(e){
                    localStorage.setItem("currentNavegationMenu","navegationLv0_1_tableros_seguimiento")
                    return {
                        type: 'route',
                        value: '/auth/navegationMenu'
                    }
                },
                active:true,
            },
            {
                id: 6,
                title:"Eventos Especiales",
                icon:"pc-cita_favorita",
                eventHandle: function(e){
                    localStorage.setItem("currentNavegationMenu","navegationLv0_4_eventos_especiales")
                    return {
                        type: 'route',
                        value: '/auth/navegationMenu'
                    }
                },
                active:true,
            },
            {
                id: 7,
                title:"Administrador",
                icon:"pc-administrador",
                eventHandle: function(e){
                    localStorage.setItem("currentNavegationMenu","navegationLv0_6_administrador")
                    return {
                        type: 'route',
                        value: '/auth/navegationMenu'
                    }
                },
                active:true,
            },
            {
                id: 8,
                title:"Consulta Externa",
                icon:"pc-solid_estetoscopio",
                route:"",
                eventHandle(){
                    return {
                        type: 'function',
                        value: ()=>{
                            alert("Acceso no disponible")
                            /* let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']
                                location.href = location.origin + "/surveyInsituIndex" */
                        }
                    }
                },
                active:false,
            },
            {
                id: 9,
                title:"Hotelería",
                icon:"pc-hoteleria",
                route:"",
                eventHandle(){
                    return {
                        type: 'function',
                        value: ()=>{
                            //alert("Acceso no disponible")
                            let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']
                                location.href = location.origin + "/auth/hoteleria?user_id="+user_id
                        }
                    }
                },
                active:true,
            },
            {
                id: menu_id++,
                title:"Satisfacción",
                icon:"pc-light-satisfation",

                eventHandle: function(e){
                    localStorage.setItem("currentNavegationMenu","navegationLv0_7_satisfaccion")
                    return {
                        type: 'route',
                        value: '/auth/navegationMenu'
                    }
                },
                active:true,
            },
            /* {
                title:"Home Care",
                icon:"pc-light-homecare",
                eventHandle: function(e){

                    return {
                        type: 'function',
                        value: ()=>{
                            let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']
                                location.href = location.origin + "/auth/areahomecare?user_id="+user_id
                        }
                    }
                },
                active:true,
            }, */
            /*temporal */
            // {
            //     title:"Visual de signos vitales",
            //     icon:"pc-paciente",
            //     eventHandle: function(e){
            //         localStorage.setItem("currentNavegationMenu","navegationHome")
            //         return {
            //             type: 'function',
            //              value: ()=>{
            //                 //alert("Acceso no disponible")
            //                 let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']
            //                     location.href = location.origin + "/auth/areaequipoEnfermeria?user_id="+user_id
            //             }
            //             /* value: ()=>{
            //                 let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']
            //                     location.href = location.origin + "/auth/areaequiposalud?user_id="+user_id
            //             } */
            //         }

            //     },

            //     active:true,
            // },
            /*temporal */
            /* {
                title:"Seguimiento de Pacientes",
                icon:"pc-paciente",
                eventHandle: function(e){
                    localStorage.setItem("currentNavegationMenu","navegationLv0_1")
                    return {
                        type: 'route',
                        value: '/auth/navegationMenu'
                    }

                },
                active:true,
            }, */
            /*temporal */
        ]
    },
    navegationLv0_1:{
        goback:{
            title:"Seguimiento de Pacientes",
            icon:"pc-paciente",
            eventHandle: function(e){
                localStorage.setItem("currentNavegationMenu","navegationHome")
                return {
                    type: 'route',
                    value: '/auth/navegationHome'
                }
            },
            active:true,
        },
        menu:[
            {
                title:"Emergencia",
                icon:"pc-emergencia",
                /* eventHandle(){
                    alert("No disponible")
                    return {
                        type: 'function',
                        value: (that)=>{
                            localStorage.setItem("currentNavegationMenu","navegationLv0_1_emergencia")
                            that.currentNavegationMenu = localStorage.getItem("currentNavegationMenu")
                        }
                    }

                }, */
                eventHandle: function(e){
                    localStorage.setItem("currentNavegationMenu","navegationLv0_1")
                    return {
                        type: 'function',
                        value: ()=>{
                            let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']
                                location.href = location.origin + "/auth/areaequiposalud2?user_id="+user_id+'&area=emergencia'
                        }
                    }
                },
                active:true,
            },
            {
                title:"Hospitalización",
                icon:"pc-light-pisos",

                eventHandle: function(e){
                    localStorage.setItem("currentNavegationMenu","navegationLv0_1")
                    return {
                        type: 'function',
                        value: ()=>{
                            let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']
                                location.href = location.origin + "/auth/areaequiposalud2?user_id="+user_id+'&area=hospitalizacion'
                        }
                    }
                },
                active:true,
            },
            {
                title:"UTI",
                icon:"pc-uti-light",
                /* eventHandle(){
                    alert("No disponible")
                    return {
                        type: 'function',
                        value: (that)=>{
                            localStorage.setItem("currentNavegationMenu","navegationLv0_3_uti")
                            that.currentNavegationMenu = localStorage.getItem("currentNavegationMenu")
                        }
                    }

                }, */
                active:true,
                eventHandle: function(e){
                    localStorage.setItem("currentNavegationMenu","navegationLv0_1")
                    return {
                        type: 'function',
                        value: ()=>{
                            let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']
                                location.href = location.origin + "/auth/areaequiposalud2?user_id="+user_id+'&area=uti'
                        }
                    }
                },
            },
            {
                title:"PAD",
                icon:"pc-light-homecare",
                eventHandle: function(e){
                    localStorage.setItem("currentNavegationMenu","navegationLv0_1")
                    return {
                        type: 'function',
                        value: ()=>{
                            let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']
                                location.href = location.origin + "/auth/areaequiposalud2?user_id="+user_id+'&area=pad'
                        }
                    }
                },
                active:true,
            },



        ]
    },
    /*INICIO TELESALUD*/
    navegationLv0_1_telesalud:{
        goback:{
            title:"Telesalud",
            icon:"pc-telesalud",
            eventHandle: function(e){
                localStorage.setItem("currentNavegationMenu","navegationHome")
                return {
                    type: 'route',
                    value: '/auth/navegationHome'
                }
            },
            active:true,
        },
        menu:[
            {
                title:"Empresas",
                icon:"pc-telesalud_empresarial",
                eventHandle(){
                    // localStorage.setItem("currentNavegationMenu","navegationHome")
                    return {
                        type: 'function',
                        value: ()=>{
                            /* alert("Acceso no disponible") */
                            let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']
                                location.href = location.origin + "/auth/telesaludempresarial?user_id="+user_id
                        }
                    }
                },
                active:true,
            },

        ],
    },
    /*FIN TELESALUD*/
    /*INICIO AREA QUIRURGICA*/
    navegationLv0_1_areaquirurgica:{
        goback:{
            title:"Área Quirúrgica",
            icon:"pc-cirugia-light",
            eventHandle: function(e){
                localStorage.setItem("currentNavegationMenu","navegationHome")
                return {
                    type: 'route',
                    value: '/auth/navegationHome'
                }
            },
            active:true,
        },
        menu:[
            {
                title:"Torre Hospitalización",
                icon:"pc-light-hospital",
                eventHandle(){
                    // localStorage.setItem("currentNavegationMenu","navegationHome")
                    return {
                        type: 'function',
                        value: ()=>{
                            /* alert("Acceso no disponible") */
                            let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']
                                location.href = location.origin + "/auth/areaquirurgica?user_id="+user_id
                        }
                    }
                },
                active:true,
            },
            {
                title:"Torre MAPM",
                icon:"pc-ambulatorio",
                eventHandle(){
                    // localStorage.setItem("currentNavegationMenu","navegationHome")
                    return {
                        type: 'function',
                        value: ()=>{
                            /* alert("Acceso no disponible") */
                            let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']
                                location.href = location.origin + "/auth/areaquirurgicaamb?user_id="+user_id
                        }
                    }
                },
                active:true,
            },

        ],
    },
    /*FIN AREA QUIRURGICA*/
    /*INICIO TABLEROS DE SEGUIMIENTO*/
    navegationLv0_1_tableros_seguimiento:{
        goback:{
            title:"Dashboards de Seguimiento",
            icon:"pc-tablero",
            eventHandle: function(e){
                localStorage.setItem("currentNavegationMenu","navegationHome")
                return {
                    type: 'route',
                    value: '/auth/navegationHome'
                }
            },
            active:true,
        },
        menu:[
            {
                title:"PAD",
                icon:"pc-light-homecare",
                eventHandle(){
                    // localStorage.setItem("currentNavegationMenu","navegationHome")
                    return {
                        type: 'function',
                        value: ()=>{
                            /* alert("Acceso no disponible") */
                           // let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']
                                window.open( location.origin + "/reportes/pad/resumen" )
                        }
                    }
                },
                active:true,
            },
            {
                title:"Censo Diario",
                icon:"pc-cita_confirmada",
                eventHandle(){
                    // localStorage.setItem("currentNavegationMenu","navegationHome")
                    return {
                        type: 'function',
                        value: ()=>{
                            /* alert("Acceso no disponible") */
                           // let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']
                                window.open( location.origin + "/reportes/ingresoscmdlt" )
                        }
                    }
                },
                active:true,
            },
            {
                title:"Egresos",
                icon:"pc-cita_confirmada",
                eventHandle(){
                    // localStorage.setItem("currentNavegationMenu","navegationHome")
                    return {
                        type: 'function',
                        value: ()=>{
                            /* alert("Acceso no disponible") */
                           // let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']
                                window.open( location.origin + "/reportes/egresoscmdlt" )
                        }
                    }
                },
                active:true,
            },

            {
                title:"Plan Quirúrgico MAPM",
                icon:"pc-ambulatorio",
                eventHandle(){
                    // localStorage.setItem("currentNavegationMenu","navegationHome")
                    return {
                        type: 'function',
                        value: ()=>{
                            /* alert("Acceso no disponible") */
                           // let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']
                                window.open( location.origin + "/areaQuirofanoAmb/externo/iqx" )
                        }
                    }
                },
                active:true,
            },
            {
                title:"Plan Quirúrgico Hospitalización",
                icon:"pc-light-hospital",
                eventHandle(){
                    // localStorage.setItem("currentNavegationMenu","navegationHome")
                    return {
                        type: 'function',
                        value: ()=>{
                            /* alert("Acceso no disponible") */
                           // let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']
                                window.open( location.origin + "/areaQuirofano/externo/iqx" )
                        }
                    }
                },
                active:true,
            },
            {
                title:"Hospitalización",
                icon:"pc-light-pisos",
                eventHandle(){
                    return {
                        type: 'function',
                        value: (that)=>{
                            localStorage.setItem("currentNavegationMenu","navegationLv0_8_seguimiento_hospitalizacion")
                            that.currentNavegationMenu = localStorage.getItem("currentNavegationMenu")
                        }
                    }
                },
                active:true,
            },
            {
                title:"Emergencia",
                icon:"pc-emergencia",
                eventHandle(){
                    // localStorage.setItem("currentNavegationMenu","navegationHome")
                    return {
                        type: 'function',
                        value: ()=>{
                            alert("Acceso no disponible")
                           // let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']
                                //window.open( location.origin + "/reportes/emergencia/resumen" )
                        }
                    }
                },
                active:false,
            },

        ],
    },
    /*FIN TABLEROS DE SEGUIMIENTO*/
    /*INICIO EMERGENCIA*/
    navegationLv0_1_emergencia:{
        goback:{
            title:"Emergencia",
            icon:"pc-emergencia",
            eventHandle: function(e){
                return {
                    type: 'function',
                    value: (that)=>{
                        localStorage.setItem("currentNavegationMenu","navegationLv0_1")
                        that.currentNavegationMenu = localStorage.getItem("currentNavegationMenu")
                    }
                }
            },
            active:true,
        },
        menu:[
            {
                title:"Adulto",
                icon:"pc-adulto",
                eventHandle(){
                    return {
                        type: 'function',
                        value: (that)=>{
                            localStorage.setItem("currentNavegationMenu","navegationLv0_1_emergencia_adulto")
                            that.currentNavegationMenu = localStorage.getItem("currentNavegationMenu")
                        }
                    }
                },
                active:true,
            },
            {
                title:"Pediátrica",
                icon:"pc-pediatrico",
                eventHandle(){
                    return {
                        type: 'function',
                        value: (that)=>{
                            localStorage.setItem("currentNavegationMenu","navegationLv0_1_emergencia_pediatrica")
                            that.currentNavegationMenu = localStorage.getItem("currentNavegationMenu")
                        }
                    }
                },
                active:true,
            },

        ]

    },
    navegationLv0_1_emergencia_adulto:{
        goback:{
            title:"Emergencia Adulto",
            icon:"pc-light-emergency",
            eventHandle(){
                return {
                    type: 'function',
                    value: (that)=>{
                        localStorage.setItem("currentNavegationMenu","navegationLv0_1_emergencia")
                        that.currentNavegationMenu = localStorage.getItem("currentNavegationMenu")
                    }
                }
            },
            active:true,
        },
        menu:[
            {
                title:"Triaje",
                icon:"pc-triaje",
                eventHandle(){
                    return {
                        type: 'function',
                        value: (that)=>{
                            localStorage.setItem("currentNavegationMenu","navegationLv0_1_emergencia_adulto_triaje")
                            that.currentNavegationMenu = localStorage.getItem("currentNavegationMenu")
                        }
                    }
                },
                active:true,
            },
            {
                title:"Observación",
                icon:"pc-observacion",
                eventHandle(){
                    return {
                        type: 'function',
                        value: ()=>{
                            alert("Acceso no disponible")
                            /* let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']
                            location.href = location.origin + "/auth/areaequiposalud?user_id="+user_id */
                        }
                    }
                },
                active:false,
            },
            {
                title:"Traumashock",
                icon:"pc-traumashock",
                route:"/level1",
                eventHandle(){
                    return {
                        type: 'function',
                        value: ()=>{
                            alert("Acceso no disponible")
                            /* let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']
                            location.href = location.origin + "/auth/areaequiposalud?user_id="+user_id */
                        }
                    }
                },
                active:false,
            },


        ]

    },
    navegationLv0_1_emergencia_adulto_triaje:{
        goback:{
            title:"Emergencia Adulto Triaje",
            icon:"pc-adulto",
            eventHandle: function(e){
                return {
                    type: 'function',
                    value: (that)=>{
                        localStorage.setItem("currentNavegationMenu","navegationLv0_1_emergencia_adulto")
                        that.currentNavegationMenu = localStorage.getItem("currentNavegationMenu")
                    }
                }
            },
            active:true,
        },
        menu:[
            {
                title:"Triaje A",
                icon:"pc-triaje",
                eventHandle(){
                    return {
                        type: 'function',
                        value: ()=>{
                            alert("Acceso no disponible")
                            /* let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']
                            location.href = location.origin + "/auth/areaequiposalud?user_id="+user_id */
                        }
                    }
                },
                active:false,
            },
            {
                title:"Triaje B",
                icon:"pc-triaje",
                eventHandle(){
                    return {
                        type: 'function',
                        value: ()=>{
                            alert("Acceso no disponible")
                            /* let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']
                            location.href = location.origin + "/auth/areaequiposalud?user_id="+user_id */
                        }
                    }
                },
                active:false,
            },

        ]

    },
    navegationLv0_1_emergencia_pediatrica:{
        goback:{
            title:"Emergencia Pediátrica",
            icon:"pc-pediatrico",
            eventHandle: function(e){
                return {
                    type: 'function',
                    value: (that)=>{
                        localStorage.setItem("currentNavegationMenu","navegationLv0_1")
                        that.currentNavegationMenu = localStorage.getItem("currentNavegationMenu")
                    }
                }
            },
            active:true,
        },
        menu:[
            {
                title:"Triaje",
                icon:"pc-triaje",
                eventHandle(){
                    return {
                        type: 'function',
                        value: (that)=>{
                            localStorage.setItem("currentNavegationMenu","navegationLv0_1_emergencia_pediatrica_triaje")
                            that.currentNavegationMenu = localStorage.getItem("currentNavegationMenu")
                        }
                    }
                },
                active:true,
            },
            {
                title:"Observación",
                icon:"pc-observacion",
                eventHandle(){
                    return {
                        type: 'function',
                        value: ()=>{
                            alert("Acceso no disponible")
                            /* let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']
                            location.href = location.origin + "/auth/areaequiposalud?user_id="+user_id */
                        }
                    }
                },
                active:false,
            },
            {
                title:"Traumashock",
                icon:"pc-traumashock",
                eventHandle(){
                    return {
                        type: 'function',
                        value: ()=>{
                            alert("Acceso no disponible")
                            /* let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']
                            location.href = location.origin + "/auth/areaequiposalud?user_id="+user_id */
                        }
                    }
                },
                active:false,
            },
            {
                title:"Sala de Nebulización",
                icon:"pc-nebulizacion",
                eventHandle(){
                    return {
                        type: 'function',
                        value: ()=>{
                            alert("Acceso no disponible")
                            /* let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']
                            location.href = location.origin + "/auth/areaequiposalud?user_id="+user_id */
                        }
                    }
                },
                active:false,
            },

        ]

    },
    navegationLv0_1_emergencia_pediatrica_triaje:{
        goback:{
            title:"Emergencia Pediátrica Triaje",
            icon:"pc-triaje",
            eventHandle: function(e){
                return {
                    type: 'function',
                    value: (that)=>{
                        localStorage.setItem("currentNavegationMenu","navegationLv0_1_emergencia_pediatrica")
                        that.currentNavegationMenu = localStorage.getItem("currentNavegationMenu")
                    }
                }
            },
            active:true,
        },
        menu:[
            {
                title:"Triaje A",
                icon:"pc-triaje",
                route:"/level1",
                eventHandle(){
                    return {
                        type: 'function',
                        value: ()=>{
                            alert("Acceso no disponible")
                            /* let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']
                            location.href = location.origin + "/auth/areaequiposalud?user_id="+user_id */
                        }
                    }
                },
                active:false,
            },
            {
                title:"Triaje B",
                icon:"pc-triaje",
                route:"/level1",
                eventHandle(){
                    return {
                        type: 'function',
                        value: ()=>{
                            alert("Acceso no disponible")
                            /* let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']
                            location.href = location.origin + "/auth/areaequiposalud?user_id="+user_id */
                        }
                    }
                },
                active:false,
            },

        ]

    },
    /*FIN EMERGENCIA*/
    /*INICIO HOSPITALIZACION*/
    navegationLv0_2_hospitalizacion:{
        goback:{
            title:"Hospitalización",
            icon:"pc-paciente",
            eventHandle: function(e){
                return {
                    type: 'function',
                    value: (that)=>{
                        localStorage.setItem("currentNavegationMenu","navegationLv0_1")
                        that.currentNavegationMenu = localStorage.getItem("currentNavegationMenu")
                    }
                }
            },
            active:true,
        },
        menu:[
            {
                title:"Corta Estancia Pediátrica",
                icon:"pc-light-pisos",
                eventHandle(){
                    return {
                        type: 'function',
                        value: ()=>{
                            alert("Acceso no disponible")
                            /* let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']
                                location.href = location.origin + "/auth/telesaludempresarial?user_id="+user_id */
                        }
                    }
                },
                active:false,
            },
            {
                title:"Piso 2",
                icon:"pc-light-pisos",
                eventHandle(){
                    return {
                        type: 'function',
                        value: ()=>{
                            alert("Acceso no disponible")
                            /* let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']
                                location.href = location.origin + "/auth/telesaludempresarial?user_id="+user_id */
                        }
                    }
                },
                active:false,
            },
            {
                title:"Piso 3",
                icon:"pc-light-pisos",
                eventHandle(){
                    return {
                        type: 'function',
                        value: ()=>{
                            alert("Acceso no disponible")
                            /* let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']
                                location.href = location.origin + "/auth/telesaludempresarial?user_id="+user_id */
                        }
                    }
                },
                active:false,
            },
            {
                title:"Piso 4",
                icon:"pc-light-pisos",
                eventHandle(){
                    return {
                        type: 'function',
                        value: ()=>{
                            alert("Acceso no disponible")
                            /* let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']
                                location.href = location.origin + "/auth/telesaludempresarial?user_id="+user_id */
                        }
                    }
                },
                active:false,
            },
            {
                title:"Piso 5",
                icon:"pc-light-pisos",
                eventHandle(){
                    return {
                        type: 'function',
                        value: ()=>{
                            alert("Acceso no disponible")
                            /* let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']
                                location.href = location.origin + "/auth/telesaludempresarial?user_id="+user_id */
                        }
                    }
                },
                active:false,
            },
            {
                title:"Piso 6",
                icon:"pc-light-pisos",
                eventHandle(){
                    return {
                        type: 'function',
                        value: ()=>{
                            alert("Acceso no disponible")
                            /* let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']
                                location.href = location.origin + "/auth/telesaludempresarial?user_id="+user_id */
                        }
                    }
                },
                active:false,
            },
        ]
    },
    /*FIN HOSPITALIZACION*/
    /*INICIO UTI*/
    navegationLv0_3_uti:{
        goback:{
            title:"UTI",
            icon:"pc-uti-light",
            eventHandle: function(e){
                return {
                    type: 'function',
                    value: (that)=>{
                        localStorage.setItem("currentNavegationMenu","navegationLv0_1")
                        that.currentNavegationMenu = localStorage.getItem("currentNavegationMenu")
                    }
                }
            },
            active:true,
        },
        menu:[
            {
                title:"UTI Adulto",
                icon:"pc-adulto",
                eventHandle(){
                    return {
                        type: 'function',
                        value: ()=>{
                            alert("Acceso no disponible")
                            /* let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']
                                location.href = location.origin + "/auth/telesaludempresarial?user_id="+user_id */
                        }
                    }
                },
                active:false,
            },
            {
                title:"UTI Pediátrico",
                icon:"pc-pediatrico",
                eventHandle(){
                    return {
                        type: 'function',
                        value: ()=>{
                            alert("Acceso no disponible")
                            /* let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']
                                location.href = location.origin + "/auth/telesaludempresarial?user_id="+user_id */
                        }
                    }
                },
                active:false,
            },




        ]
    },
    /*FIN UTI*/
    /*INICIO EVENTOS ESPECIALES*/
    navegationLv0_4_eventos_especiales:{
        goback:{
            title:"Eventos Especiales",
            icon:"pc-cita_favorita",
            eventHandle: function(e){
                localStorage.setItem("currentNavegationMenu","navegationHome")
                return {
                    type: 'route',
                    value: '/auth/navegationHome'
                }
            },
            active:true,
        },
        menu:[
            {
                title:"Padel Fest 2024",
                icon:"pc-padel",
                eventHandle(){
                    // localStorage.setItem("currentNavegationMenu","navegationHome")
                    return {
                        type: 'function',
                        value: ()=>{
                            /* alert("Acceso no disponible") */
                           // let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']
                           window.open( location.origin + "/reportes/ee3/resumen" )
                        }
                    }
                },
                active:true,
            },
            {
                title:"Padel Fabrice Pastor Cup",
                icon:"pc-padel",
                eventHandle(){
                    return {
                        type: 'function',
                        value: ()=>{
                            alert("Acceso no disponible")
                            /* let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']
                                location.href = location.origin + "/auth/telesaludempresarial?user_id="+user_id */
                        }
                    }
                },
                active:false,
            },
            {
                title:"Padel Fest",
                icon:"pc-padel",
                eventHandle(){
                    // localStorage.setItem("currentNavegationMenu","navegationHome")
                    return {
                        type: 'function',
                        value: ()=>{
                            /* alert("Acceso no disponible") */
                           // let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']
                           window.open( location.origin + "/reportes/ee/resumen" )
                        }
                    }
                },
                active:true,
            },


        ]

    },
    /*FIN EVENTOS ESPECIALES*/
    /*INICIO pad*/
    navegationLv0_5_pad:{
        goback:{
            title:"PAD",
            icon:"pc-light-homecare",
            eventHandle: function(e){
                return {
                    type: 'function',
                    value: (that)=>{
                        localStorage.setItem("currentNavegationMenu","navegationLv0_1")
                        that.currentNavegationMenu = localStorage.getItem("currentNavegationMenu")
                    }
                }
            },
            active:true,
        },
        menu:[
            {
                title:"PAD Emergencia",
                icon:"pc-pad_emergencia",
                eventHandle(){
                    return {
                        type: 'function',
                        value: ()=>{
                            alert("Acceso no disponible")
                            /* let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']
                                location.href = location.origin + "/auth/telesaludempresarial?user_id="+user_id */
                        }
                    }
                },
                active:false,
            },
            {
                title:"PAD Médico",
                icon:"pc-light-pad-medico",
                eventHandle(){
                    return {
                        type: 'function',
                        value: ()=>{
                            alert("Acceso no disponible")
                            /* let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']
                                location.href = location.origin + "/auth/telesaludempresarial?user_id="+user_id */
                        }
                    }
                },
                active:false,
            },
            {
                title:"PAD Post Quirúrgico",
                icon:"pc-light-pad-quiru",
                eventHandle(){
                    return {
                        type: 'function',
                        value: ()=>{
                            alert("Acceso no disponible")
                            /* let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']
                                location.href = location.origin + "/auth/telesaludempresarial?user_id="+user_id */
                        }
                    }
                },
                active:false,
            },
            {
                title:"PAD Cardiología Insuficiencia Cardíaca",
                icon:"pc-pad_cardiologia",
                eventHandle(){
                    return {
                        type: 'function',
                        value: ()=>{
                            alert("Acceso no disponible")
                            /* let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']
                                location.href = location.origin + "/auth/telesaludempresarial?user_id="+user_id */
                        }
                    }
                },
                active:false,
            },
            {
                title:"PAD Cardiología Hipertensión Arterial",
                icon:"pc-pad_cardiologia",
                eventHandle(){
                    return {
                        type: 'function',
                        value: ()=>{
                            alert("Acceso no disponible")
                            /* let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']
                                location.href = location.origin + "/auth/telesaludempresarial?user_id="+user_id */
                        }
                    }
                },
                active:false,
            },
        ]

    },
    /*FIN pad*/
    /*INICIO administrador*/
    navegationLv0_6_administrador:{
        goback:{
            title:"Administrador",
            icon:"pc-paciente",
            eventHandle: function(e){
                localStorage.setItem("currentNavegationMenu","navegationHome")
                return {
                    type: 'route',
                    value: '/auth/navegationHome'
                }
            },
            active:true,
        },
        menu:[
            {
                title:"Equipo Médico",
                icon:"pc-equipo_medico",
                eventHandle(){
                    // localStorage.setItem("currentNavegationMenu","navegationHome")
                    return {
                        type: 'function',
                        value: ()=>{
                            /* alert("Acceso no disponible") */
                            let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']
                                location.href = location.origin + "/auth/authlistmedicos?user_id="+user_id
                        }
                    }
                },
                active:true,
            },
            {
                title:"Gestión de Usuarios",
                icon:"pc-card_user",
                eventHandle(){
                    return {
                        type: 'function',
                        value: ()=>{
                            alert("Acceso no disponible")
                            /* let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']
                                location.href = location.origin + "/auth/telesaludempresarial?user_id="+user_id */
                        }
                    }
                },
                active:false,
            },
            {
                title:"Reportes",
                icon:"pc-reportes",
                eventHandle: function(e){
                    return {
                        type: 'function',
                        value: (that)=>{
                            localStorage.setItem("currentNavegationMenu","navegationLv0_1_dashboard_reportes")
                            that.currentNavegationMenu = localStorage.getItem("currentNavegationMenu")
                        }
                    }
                },
                active:true,
            },

        ]

    },
    /*FIN administrador*/
    /*INICIO satisfaccion*/
    navegationLv0_7_satisfaccion:{
        goback:{
            title:"Satisfacción",
            icon:"pc-light-satisfation",
            eventHandle: function(e){
                localStorage.setItem("currentNavegationMenu","navegationHome")
                return {
                    type: 'route',
                    value: '/auth/navegationHome'
                }
            },

            active:true,
        },
        menu:[
            {
                title:"Monitor de Encuestas",
                icon:"pc-light-satisfation",
                eventHandle(){
                    // localStorage.setItem("currentNavegationMenu","navegationHome")
                    return {
                        type: 'function',
                        value: ()=>{
                            /* alert("Acceso no disponible") */
                            //let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']
                                location.href = location.origin + "/surveys_index"
                        }
                    }
                },
                active:true,
            },
            {
                title:"Gestión de Encuestas",
                icon:"pc-light-satisfation",
                eventHandle(){
                    return {
                        type: 'function',
                        value: ()=>{
                            location.href = location.origin + "/dischargeds/sendSurveyList"
                            //alert("Acceso no disponible")
                            /* let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']
                                location.href = location.origin + "/auth/telesaludempresarial?user_id="+user_id */
                        }
                    }
                },
                active:true,
            },


        ]

    },
    /*FIN satisfaccion*/
    /*INICIO DASHBOARD DE SEGUIMIENTO HOSPITALIZACION*/
    navegationLv0_8_seguimiento_hospitalizacion:{
        goback:{
            title:"Hospitalización",
            icon:"pc-light-pisos",
            eventHandle(){
                return {
                    type: 'function',
                    value: (that)=>{
                        localStorage.setItem("currentNavegationMenu","navegationLv0_1_tableros_seguimiento")
                        that.currentNavegationMenu = localStorage.getItem("currentNavegationMenu")
                    }
                }
            },
            active:true,
        },
        menu:[
            {
                title:"Pacientes en Piso",
                icon:"pc-light-pisos",
                eventHandle(){
                    return {
                        type: 'function',
                        value: (that)=>{
                            localStorage.setItem("currentNavegationMenu","navegationLv0_1_pacientes_en_piso")
                            that.currentNavegationMenu = localStorage.getItem("currentNavegationMenu")
                        }
                    }
                },
                /* eventHandle: function(e){
                    localStorage.setItem("currentNavegationMenu","navegationHome")
                    return {
                        type: 'function',
                        value: ()=>{
                            let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']
                                window.open( location.origin + "/auth/areahospitalizacion?user_id="+user_id )
                        }
                    }
                }, */
                active:true,
            },
            {
                title:"Totales Hospitalización y Uti",
                icon:"pc-light-pisos",
                eventHandle(){
                    // localStorage.setItem("currentNavegationMenu","navegationHome")
                    return {
                        type: 'function',
                        value: ()=>{

                           // let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']
                                window.open( location.origin + "/reportes/hospitalizacion/resumen" )
                        }
                    }
                },
                active:true,
            },



        ]

    },
    /*FIN  DASHBOARD DE SEGUIMIENTO HOSPITALIZACION*/
    /*INICIO PACIENTES EN PISO*/
    navegationLv0_1_pacientes_en_piso:{
        goback:{
            title:"Pacientes en piso",
            icon:"pc-light-pisos",
            eventHandle(){
                return {
                    type: 'function',
                    value: (that)=>{
                        localStorage.setItem("currentNavegationMenu","navegationLv0_8_seguimiento_hospitalizacion")
                        that.currentNavegationMenu = localStorage.getItem("currentNavegationMenu")
                    }
                }
            },
            active:true,
        },
        menu:[
            {
                title:"PISO 2 A",
                icon:"pc-light-pisos",
                eventHandle(){
                    // localStorage.setItem("currentNavegationMenu","navegationHome")
                    return {
                        type: 'function',
                        value: ()=>{
                            let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']
                                location.href = location.origin + "/auth/areahospitalizacion?user_id="+user_id+"&piso=2&ala=a"

                        }
                    }
                },
                active:true,
            },
            {
                title:"PISO 2 B",
                icon:"pc-light-pisos",
                eventHandle(){
                    // localStorage.setItem("currentNavegationMenu","navegationHome")
                    return {
                        type: 'function',
                        value: ()=>{
                            let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']
                                location.href = location.origin + "/auth/areahospitalizacion?user_id="+user_id+"&piso=2&ala=b"

                        }
                    }
                },
                active:true,
            },
            {
                title:"PISO 3 A",
                icon:"pc-light-pisos",
                eventHandle(){
                    // localStorage.setItem("currentNavegationMenu","navegationHome")
                    return {
                        type: 'function',
                        value: ()=>{
                            let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']
                                location.href = location.origin + "/auth/areahospitalizacion?user_id="+user_id+"&piso=3&ala=a"

                        }
                    }
                },
                active:true,
            },
            {
                title:"PISO 3 B",
                icon:"pc-light-pisos",
                eventHandle(){
                    // localStorage.setItem("currentNavegationMenu","navegationHome")
                    return {
                        type: 'function',
                        value: ()=>{
                            let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']
                                location.href = location.origin + "/auth/areahospitalizacion?user_id="+user_id+"&piso=3&ala=b"

                        }
                    }
                },
                active:true,
            },
            {
                title:"PISO 4 A",
                icon:"pc-light-pisos",
                eventHandle(){
                    // localStorage.setItem("currentNavegationMenu","navegationHome")
                    return {
                        type: 'function',
                        value: ()=>{
                            let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']
                            location.href = location.origin + "/auth/areahospitalizacion?user_id="+user_id+"&piso=4&ala=a"
                        }
                    }
                },
                active:true,
            },
            {
                title:"PISO 4 B",
                icon:"pc-light-pisos",
                eventHandle(){
                    // localStorage.setItem("currentNavegationMenu","navegationHome")
                    return {
                        type: 'function',
                        value: ()=>{
                            let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']
                            location.href = location.origin + "/auth/areahospitalizacion?user_id="+user_id+"&piso=4&ala=b"
                        }
                    }
                },
                active:true,
            },
            {
                title:"PISO 5 A",
                icon:"pc-light-pisos",
                eventHandle(){
                    // localStorage.setItem("currentNavegationMenu","navegationHome")
                    return {
                        type: 'function',
                        value: ()=>{
                            let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']
                            location.href = location.origin + "/auth/areahospitalizacion?user_id="+user_id+"&piso=5&ala=a"
                        }
                    }
                },
                active:true,
            },
            {
                title:"PISO 5 B",
                icon:"pc-light-pisos",
                eventHandle(){
                    // localStorage.setItem("currentNavegationMenu","navegationHome")
                    return {
                        type: 'function',
                        value: ()=>{
                            let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']
                            location.href = location.origin + "/auth/areahospitalizacion?user_id="+user_id+"&piso=5&ala=b"
                        }
                    }
                },
                active:true,
            },
            {
                title:"PISO 6 A",
                icon:"pc-light-pisos",
                eventHandle(){
                    // localStorage.setItem("currentNavegationMenu","navegationHome")
                    return {
                        type: 'function',
                        value: ()=>{
                            let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']
                            location.href = location.origin + "/auth/areahospitalizacion?user_id="+user_id+"&piso=6&ala=a"
                        }
                    }
                },
                active:true,
            },
            {
                title:"PISO 6 B",
                icon:"pc-light-pisos",
                eventHandle(){
                    // localStorage.setItem("currentNavegationMenu","navegationHome")
                    return {
                        type: 'function',
                        value: ()=>{
                            let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']
                            location.href = location.origin + "/auth/areahospitalizacion?user_id="+user_id+"&piso=6&ala=b"
                        }
                    }
                },
                active:true,
            },




        ],
    },
    /*FIN TABLEROS PACIENTES EN PISO*/
    /*INICIO DASHBOARD REPORTES*/
    navegationLv0_1_dashboard_reportes:{
        goback:{
            title:"Administrador",
            icon:"pc-administrador",
            eventHandle(){
                return {
                    type: 'function',
                    value: (that)=>{
                        localStorage.setItem("currentNavegationMenu","navegationLv0_6_administrador")
                        that.currentNavegationMenu = localStorage.getItem("currentNavegationMenu")
                    }
                }
            },
            active:true,
        },
        menu:[
            {
                title:"Evoluciones RAMH",
                icon:"pc-administrador",
                eventHandle(){
                    // localStorage.setItem("currentNavegationMenu","navegationHome")
                    return {
                        type: 'function',
                        value: ()=>{

                           // let user_id = JSON.parse( localStorage.getItem("user_profile") )['user_id']
                                window.open( location.origin + "/user/reportes/evoluciones/ramh" )
                        }
                    }
                },
                active:true,
            },




        ]

    },
    /*INICIO DASHBOARD REPORTES*/
}











