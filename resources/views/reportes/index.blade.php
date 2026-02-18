<!doctype html>
<html lang="en">

    <head>
        <title>Reporte PAD</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="/css/stylePatientcare.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="{{asset('image/system/icomoon3/style.css')}}">
        <style>
            i.fas.fa-male.text-success.h2:hover {
                color: white !important;
                cursor: pointer;
            }


            /* .users_buttons{
                display:none;
            } */
            body{
                    background-color: #213647;
                    padding: 1rem;
                    margin: 0 auto;
                    max-width: 1725px;
                }
            .icon-home{
                font-size: 6rem;
                }
            .icon-logo-institution{
                    height: 6em;
                }


            @media (min-width: 0px) {
                i.h2{
                    font-size:1rem;
                }
                .item-count {
                    font-size: 4rem;
                    line-height: 0.6;
                }
                .count-type-user{
                    font-size: 1rem;
                }
                .icon-report-men{
                    font-size: 3rem;
                }
                .icon-home {
                    font-size: 3rem;
                }
                .icon-logo-institution {
                    height: 2.6em;
                }
                .header-titles.h1 {
                    font-size: 0.7rem;
                }
                .header-titles-2.h2{
                    font-size: 1rem;
                }
            }
            @media (max-width: 576px) {
                .row.users_buttons{
                    margin-right: 1rem;
                    margin-left: 1rem;
                }
                .row.users_buttons > .col-1-custom{
                    -ms-flex: 0 0 3% !important;
                    flex: 0 0 3% !important;
                    position: relative !important;
                    text-align: center !important;
                    width: 10px !important;
                    padding-right: 0.2rem !important;
                    padding-left: 0.2rem !important;
                }
            }
            @media (min-width: 576px) {
                .icon-report-men{
                    font-size: 20rem;
                }
                i.h2{
                    font-size:2rem;
                }
                .users_buttons{
                    display:flex;
                }
                .icon-home {
                    font-size: 3rem;
                }
                .icon-logo-institution {
                    height: 2.6em;
                }
                .header-titles.h1 {
                    font-size: 1.3rem;
                }
                .header-titles-2.h2{
                    font-size: 1rem;
                }
            }
            @media (min-width: 992px) {
                .item-count{
                    font-size: 6rem;
                    line-height: 0.6;
                }
                .count-type-user{
                    font-size: 1.5rem;
                }
                .icon-home {
                    font-size: 6rem;
                }
                .icon-logo-institution {
                    height: 6em;
                }
                .header-titles.h1 {
                    font-size: 2.5rem;
                }
                .header-titles-2.h2{
                    font-size: 2rem;
                }
            }
            .rotate-in-ver{-webkit-animation:rotate-in-ver .5s cubic-bezier(.25,.46,.45,.94) both;animation:rotate-in-ver .5s cubic-bezier(.25,.46,.45,.94) both}
            @-webkit-keyframes rotate-in-ver{0%{-webkit-transform:rotateY(-360deg);transform:rotateY(-360deg);opacity:0}100%{-webkit-transform:rotateY(0deg);transform:rotateY(0deg);opacity:1}}@keyframes rotate-in-ver{0%{-webkit-transform:rotateY(-360deg);transform:rotateY(-360deg);opacity:0}100%{-webkit-transform:rotateY(0deg);transform:rotateY(0deg);opacity:1}}
            .scale-in-ver-top{-webkit-animation:scale-in-ver-top .5s cubic-bezier(.25,.46,.45,.94) both;animation:scale-in-ver-top .5s cubic-bezier(.25,.46,.45,.94) both}
            @-webkit-keyframes scale-in-ver-top{0%{-webkit-transform:scaleY(0);transform:scaleY(0);-webkit-transform-origin:100% 0;transform-origin:100% 0;opacity:1}100%{-webkit-transform:scaleY(1);transform:scaleY(1);-webkit-transform-origin:100% 0;transform-origin:100% 0;opacity:1}}@keyframes scale-in-ver-top{0%{-webkit-transform:scaleY(0);transform:scaleY(0);-webkit-transform-origin:100% 0;transform-origin:100% 0;opacity:1}100%{-webkit-transform:scaleY(1);transform:scaleY(1);-webkit-transform-origin:100% 0;transform-origin:100% 0;opacity:1}}
        </style>
    </head>
    <body>

        <div class="d-flex flex-sm-wrap">
            <div>
                <i class="icon-home pc-light-homecare text-white h1"></i>
            </div>
            <div>
                <div class="d-flex header-titles h1 flex-column font-weight-bold">
                    <div class="text-white">
                        GERENCIA DE INNOVACIÓN
                    </div>
                    <div class="text-warning">
                        PROGRAMA DE ATENCIÓN DOMICILIARIA
                    </div>
                </div>
            </div>
            <div class="flex-grow-1">
                <div class="d-flex justify-content-end">
                    <div>
                        <img class="icon-logo-institution" src="/image/system/logo-cmdlt-blanco.svg" alt="">
                    </div>
                </div>

            </div>
        </div>
        <div class="d-flex header-titles-2 flex-wrap h2 text-white">
            <div class="px-2 report-text-date report bg-danger">
                Septiembre 14, 2022 5:00pm
            </div>
            <div class=" report-text-title-document border-bottom border-danger pl-sm-2">
                Total de pacientes diarios monitoreados en el PAD
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-3">
                <div class="d-flex mt-5 mt-sm-0 flex-row flex-sm-column justify-content-around my-1 mb-3 my-md-5 align-items-center">
                    <div>
                        <i class="icon-report-men text-white fas fa-male rotate-in-ver" ></i>
                    </div>

                    <div class="h2 item-title text-center text-white text-uppercase">
                        total
                    </div>
                    <div class="item-count item-count-total-pad font-weight-bold text-warning" style="height: 0.7em;">
                        0
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-2 mt-md-4 text-white">
                    <div>
                        <i title="Paciente Estable" class="fas fa-male text-success ml-2 mr-1 h2"></i> Estable
                        <i title="Paciente Intermedio" class="fas fa-male text-warning ml-2 mr-1 h2"></i> Intermedio
                        <i title="Paciente De cuidado" class="fas fa-male text-danger ml-2 mr-1 h2"></i> De cuidado
                    </div>

                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-9">
                <div class="row mt-sm-5" id="cards_pad_box">

                </div>
            </div>

        </div>

        <!-- card pad -->
        <template id="template_0001">
            <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                <div class="d-flex font-weight-bold flex-column align-items-center">
                    <div class="h2 cursor-pointer item-title text-center text-white text-uppercase">
                        No Indicado
                    </div>
                    <div>
                        <div class="d-flex text-warning">
                            <div class="item-count border-right border-warning pr-2" style="height: 0.7em;">
                                0
                            </div>
                            <div class="pl-3">
                                <div class="d-flex flex-column count-type-user" >
                                    <div>
                                        Pediátrico: <span class="item-count-sub-count-1 text-white float-right pl-2">0</span>
                                    </div>
                                    <div>
                                        Adulto: <span class="item-count-sub-count-2 text-white float-right pl-2">0</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="container-fluid pt-3">
                            <div class="row justify-content-center  users_buttons" style="    max-width: 20rem;">
                                {{--  <div class="col-1">
                                    <i class="fas fa-male text-success h2"></i>
                                </div> --}}

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </template>
        <!-- tooltip info -->
        <template id="template_0002">
            <p>
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ducimus expedita ut sunt voluptatibus quas accusantium porro. Tempora mollitia, fuga quas iste facilis tenetur tempore, exercitationem earum commodi perspiciatis incidunt natus.
            </p>
        </template>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
        </script>
        <script src="https://unpkg.com/@popperjs/core@2"></script>
        <script src="https://unpkg.com/tippy.js@6"></script>
        <script src="/js/html2canvas.min.js"></script>
        <script>
            let d = document
            let useState= {
                    "pad_emergencia":{"title":"PAD EMERGENCIA","adulto":null,"pediatrico":null,"total":null },
                    "pad_medico":{"title":"PAD MÉDICO", "adulto":null,"pediatrico":null,"total":null },
                    "pad_quirurgico":{"title":"PAD QUIRÚRGICO", "adulto":null,"pediatrico":null,"total":null },
                    "total":function(){
                        let total = [];
                            Object.values(this).forEach((element,key) => {
                                if (key < (Object.values(this).length -1) ) {
                                    total.push( element['total'] )
                                }
                            });
                            return total
                     }
                }

                function meses(p) {
                    let mes = [
                        "Enero",
                        "Febrero",
                        "Marzo",
                        "Abril",
                        "Mayo",
                        "Junio",
                        "Julio",
                        "Agosto",
                        "Septiembre",
                        "Octubre",
                        "Noviembre",
                        "Diciembre",
                        "Enero"
                    ]
                    return mes[p];
                }
                function formatAMPM(date) {

                    var hours = date.getHours();
                    var minutes = date.getMinutes();
                    var seconds = date.getSeconds();
                    var ampm = hours >= 12 ? 'PM' : 'AM';
                    hours = hours % 12;
                    hours = hours ? hours : 12; // the hour '0' should be '12'
                    minutes = minutes < 10 ? '0' + minutes : minutes;
                    var strTime = hours + ':' + minutes + ':' + seconds + ' ' + ampm;

                    return strTime;
                }
                async function get(url) {
                    try {
                        const response = await fetch(
                            url, {
                                method: 'GET',
                                headers: {
                                    'Content-Type': 'application/json'
                                }
                            });
                        return await response.json();
                    } catch (err) {
                        console.error(err.message);
                    }
                }
                async function reportePad() {
                    return await get("/vistas/v_pad_reporte_diario")
                }
                start = async ()=>{
                    d.querySelector(".icon-report-men").classList.remove( "rotate-in-ver" )
                                    //FECHA DEL REPORTE
                    let fecha = f = new Date();
                        fecha = meses(f.getMonth()).toUpperCase()+ " " + f.getDate() + ", " + f.getFullYear()  + " " + formatAMPM(fecha);
                        d.querySelector('.report-text-date').innerHTML=fecha


                    let model = await reportePad();
                        useState['pad_emergencia']['adulto'] = model.filter(pad => [229].includes( pad['cat_user_ubicacion_id'] ) && pad['edad'] > 17  )
                        useState['pad_emergencia']['pediatrico'] = model.filter(pad => [228].includes( pad['cat_user_ubicacion_id'] ) && pad['edad'] < 18 )
                        useState['pad_emergencia']['total'] = model.filter(pad => [229,228].includes( pad['cat_user_ubicacion_id'] ) )

                        useState['pad_medico']['adulto'] = model.filter(pad => [382].includes( pad['cat_user_ubicacion_id'] ) && pad['edad'] > 17 )
                        useState['pad_medico']['pediatrico'] = model.filter(pad => [382].includes( pad['cat_user_ubicacion_id'] ) && pad['edad'] < 18 )
                        useState['pad_medico']['total'] = model.filter(pad => [382].includes( pad['cat_user_ubicacion_id'] ) )

                        useState['pad_quirurgico']['adulto'] = model.filter(pad => [373,374].includes( pad['cat_user_ubicacion_id'] ) && pad['edad'] > 17 )
                        useState['pad_quirurgico']['pediatrico'] = model.filter(pad => [373,374].includes( pad['cat_user_ubicacion_id'] ) && pad['edad'] < 18 )
                        useState['pad_quirurgico']['total'] = model.filter(pad => [373,374].includes( pad['cat_user_ubicacion_id'] ) )

                        useState['total'] = model.filter(pad => [229,228,382,373,374].includes( pad['cat_user_ubicacion_id'] ) )

                        d.querySelector(".item-count-total-pad").textContent = useState['total'].length



                    let box = d.getElementById("cards_pad_box");

                        box.innerHTML = null

                        Object.values(useState).forEach((element,key) => {
                            if ((key+1) <= (Object.values(useState).length -1) ) {
                                //console.log( (key) , (Object.values(useState).length -1)  )

                                let card = d.getElementById("template_0001").content.cloneNode(true)
                                let total = element['total'].length
                                    console.log(element)
                                    if (key < (Object.values(useState).length -2) ) {
                                        card.querySelector(".col-12.col-sm-6.col-md-4.col-lg-4").classList.add("border-right","border-secondary")
                                    }

                                    card.querySelector(".item-title").textContent =element['title']
                                    card.querySelector(".item-title").dataset['bsTarget']=`collapse_${(key+1)}`
                                    //card.querySelector(".collapse-horizontal").setAttribute('id',`collapse_${(key+1)}`)
                                    card.querySelector(".item-count").textContent = total
                                    card.querySelector(".item-count-sub-count-1").textContent =element['pediatrico'].length
                                    card.querySelector(".item-count-sub-count-2").textContent =element['adulto'].length

                                    element['total'].forEach(user=>{
                                        let color = (user)=>{
                                            //console.log("🚀 ~ file: index.blade.php ~ line 361 ~ color ~ user", Number(user['alert']))

                                                switch(Number(user['alert'])){
                                                    case 1: return 'success'; break;
                                                    case 2: return 'warning'; break;
                                                    case 3: return 'danger'; break;
                                                    default: return 'success'; break;
                                                }
                                            }
                                        card.querySelector(".users_buttons").insertAdjacentHTML("beforeend",`
                                            <div class="col-1 col-1-custom">
                                                <i id="template_${user['user_id_paciente']}" class="fas fa-male text-${color(user)} h2"></i>
                                            </div>
                                        `)
                                        /* tippy(`#template_${user['user_id_paciente']}`, {
                                            content: `
                                                <strong>Bolded content</strong>
                                            `,
                                            allowHTML: true,
                                        }); */
                                    })


                                    box.append(card)


                            }
                        });
                        Object.values(useState).forEach((element,key) => {
                            if ((key+1) <= (Object.values(useState).length -1) ) {

                                    element['total'].forEach(user=>{
                                        let color = (user)=>{
                                            //console.log("🚀 ~ file: index.blade.php ~ line 361 ~ color ~ user", Number(user['alert']))

                                                switch(Number(user['alert'])){
                                                    case 1: return 'success'; break;
                                                    case 2: return 'warning'; break;
                                                    case 3: return 'danger'; break;
                                                    default: return 'success'; break;
                                                }
                                            }

                                        tippy(`#template_${user['user_id_paciente']}`, {
                                            content: `
                                                <strong>${user['paciente']} ${user['user_id_paciente']}</strong>
                                                <div>
                                                    <div>
                                                        <b>Edad:</b> ${user['edad']} años
                                                    </div>
                                                    <div>
                                                        <b>Ingreso:</b> ${user['ingreso']}
                                                    </div>
                                                    <div>
                                                        <b>Días:</b> ${user['dias']}
                                                    </div>
                                                </div>
                                            `,
                                            theme: 'tooltip-cmdlt-'+color(user),
                                            allowHTML: true,
                                        });
                                    })


                                    /* box.append(card) */


                            }
                        });

                        d.querySelector(".icon-report-men").classList.add( "rotate-in-ver" )
                }
            d.addEventListener("DOMContentLoaded", async function(){
                setInterval( async() => {
                    await start()

                }, 60000);
                    await start()

                    /* console.log(useState['pad_emergencia']['total']())
                    console.log(useState['pad_medico']['total']())
                    console.log(useState['pad_quirurgico']['total']()) */
            })
        </script>
    </body>

</html>
