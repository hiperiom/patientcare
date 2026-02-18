import {getRouteParams,get} from "../helpers/helpers.js";
import Component from "./Component.js";

import UserCuestEpisodio from "./UserCuestEpisodio.js";
let tp = async ()=>
    {
        let area = localStorage.getItem('area')
            return await get( location.origin+"/vistas/" + area )
    }

let AreaSwitch = (a)=> {
        let area_id;
            switch (a) {
                default: area_id=[]; break;
                case 'ea':area_id=[2,3,270]; break;
                case 'ecvd':area_id=[6,7,10]; break;
                case 'ep':area_id=[29,32]; break;
                case 'aq':area_id=[41]; break;
                case 'hcep':area_id=[390]; break;
                case 'hp2':area_id=[42,43]; break;
                case 'hp3':area_id=[70,71]; break;
                case 'hp4':area_id=[99,98]; break;
                case 'hp5':area_id=[126,127]; break;
                case 'hp6':area_id=[154,155]; break;
                case 'utia':area_id=[183,182]; break;
                case 'uticvd':area_id=[194,195]; break;
                case 'utip':area_id=[212]; break;
                case 'utin':area_id=[390]; break;
                case 'pad':area_id=[223,224,225,226,227,228,229,357]; break;
            }
            $('#area-'+a).tab('show')
        return area_id;
    }
    if(localStorage.getItem('area') == null){
        localStorage.setItem('area','tp')
    }
    let pacientes_datos = null
    let table;
    let getArea_id = localStorage.getItem('area') != null ? localStorage.getItem('area') : 'tp'
    let area_id = localStorage.getItem('area')

    document.addEventListener("DOMContentLoaded",async ()=>{
        pacientes_datos = await tp()
        UserCuestEpisodio.listadoEntrega({area_id:AreaSwitch(localStorage.getItem('area')),pacientes_datos})
        $(".link-area").on("click", async function () {

            let area_id = $(this).data("area")
                localStorage.setItem('area',area_id)
                $("#sinresultados").css("display","none")
                $("#example,#example_wrapper").css("display","none")
                $("#cargando").css("display","flex")
                pacientes_datos = await tp()
            let model =[];
                if (AreaSwitch(localStorage.getItem('area')).length > 0) {
                    AreaSwitch(localStorage.getItem('area')).forEach((y,index)=>{
                        pacientes_datos.forEach(x =>{
                            if (x.parent_cat_user_ubicacion_id === y) {
                                model.push(x)
                            }
                        })
                    })

                }else{
                    model = pacientes_datos;
                }
                $("#cargando").css("display","none")

                if (model.length > 0) {
                    //console.log(table)
                    $("#sinresultados").css("display","none")
                    $("#example,#example_wrapper").css("display","flex")



                    UserCuestEpisodio.listadoEntrega({area_id:AreaSwitch(localStorage.getItem('area')),pacientes_datos})

                }else{
                    $("#sinresultados").css("display","flex")
                    $("#example,#example_wrapper").css("display","none")

                };
        });
        $("#search").trigger("focus");
        if (pacientes_datos.length > 0) {



        }else{
            $("#sinresultados").css("display","flex")

        }


        let minutos =1;//valor a cambiar
        let milisegundos = minutos*60000;
            setInterval(function () {
                get('/sessionExist')
                .then(response=>{
                    if(response){

                        message = Component.alertMessage("expire_sesion");
                        Toast.fire({
                            icon: message['imagen'],
                            title: message['title'],
                            text: message['message'],
                            timer:15000,
                            didOpen: () => {
                                setInterval(() => {
                                    location.href = '/finalizarSesion'
                                }, 14000)
                            },
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.href = '/finalizarSesion'
                            }
                            if (result.dismiss === Swal.DismissReason.timer) {
                                location.href = '/finalizarSesion'
                            }
                        })
                        //location.href = '/finalizarSesion'
                        //alert("Su sesión ha finalizado por inactividad")
                    }
                })
            },milisegundos);
    })
    $(document).ready( function () {

            /* model.then(response=>{
                pacientes_datos = model


            })

         */




    });

