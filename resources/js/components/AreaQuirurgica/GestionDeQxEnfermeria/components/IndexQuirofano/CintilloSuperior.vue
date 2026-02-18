<template>
    <div ref="cintillo_superior" :class="['container-fluid px-0 mb-1 ',getMaximize]">
        <div class="d-flex justify-content-end">
<!-- ,'d-block':getMaximize -->
            <div class="col-4 px-0">
                <div class="card py-1 px-2  p-md-3 m-1" style="border-radius:1.25rem;">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center text-primary">
                        <div class="card-title text-warning text-center text-md-left">
                            PRE-ANESTESIA
                        </div>
                        <b class="card-title-total">{{$store.state.listadoSolicitudesQx.map(x=>x['dias']).flat().length}}</b>
                    </div>
                </div>
            </div>
            <div class="col-4 px-0">
                <div class="card py-1 px-2  p-md-3 m-1" style="border-radius:1.25rem;">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center text-primary">
                        <div class="card-title text-center text-md-left">
                            RECUPERACIÓN
                        </div>
                        <b class="card-title-total">{{$store.state.listadoSolicitudesQx.map(x=>x['dias']).flat().filter(x=> [418,420,421].includes( Number( x['area_intervencion'] ) ) ).length}}</b>
                    </div>
                </div>
            </div>
            <div class="col-4 px-0">
                <div class="card py-1 px-2  p-md-3 m-1" style="border-radius:1.25rem;">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center text-primary">
                        <div class="card-title text-center text-md-left">
                            PRE Y POST OBSTÉTRICO / PEDIATRÍA
                        </div> <!--418,420,421,425-->
                        <b class="card-title-total">{{$store.state.listadoSolicitudesQx.map(x=>x['dias']).flat().filter(x=> [419,422,423,424,425].includes( Number( x['area_intervencion'] ) ) ).length}}</b>
                    </div>
                </div>
            </div>


        </div>
    </div>
</template>

<script>
    export default {
        computed:{
            getMaximize(){
                return this.$store.state.maximize ==="true" ? 'fade-in-top ' : 'fade-out-top '
            }
        },
    }
</script>

<style  scoped>
    .fade-in-top {
        -webkit-animation: fade-in-top 0.6s cubic-bezier(0.390, 0.575, 0.565, 1.000) both;
        animation: fade-in-top 0.6s cubic-bezier(0.390, 0.575, 0.565, 1.000) both;
    }
    @-webkit-keyframes fade-in-top {
        0% {
            -webkit-transform: translateY(-50px);
            transform: translateY(-50px);
             opacity: 0;
            display: none;
        }
        100% {
            -webkit-transform: translateY(0);
            transform: translateY(0);
            opacity: 1;
            display: block;
        }
    }
    @keyframes fade-in-top {
        0% {
            -webkit-transform: translateY(-50px);
            transform: translateY(-50px);
            opacity: 0;
            display: none;
        }
        100% {
            -webkit-transform: translateY(0);
            transform: translateY(0);
            opacity: 1;
            display: block;
        }
    }
    .fade-out-top {
        -webkit-animation: fade-out-top 0.7s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
                animation: fade-out-top 0.7s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
    }
    @-webkit-keyframes fade-out-top {
        0% {
            -webkit-transform: translateY(0);
                    transform: translateY(0);
                     opacity: 1;
             display: block;
        }
        100% {
            -webkit-transform: translateY(-50px);
                    transform: translateY(-50px);
                    opacity: 0;
            display: none;
        }
    }
    @keyframes fade-out-top {
        0% {
            -webkit-transform: translateY(0);
                    transform: translateY(0);
                     opacity: 1;
             display: block;
        }
        100% {
            -webkit-transform: translateY(-50px);
                    transform: translateY(-50px);
                    opacity: 0;
            display: none;
        }
    }





    .fade-in-bottom {
        -webkit-animation: fade-in-bottom 0.6s cubic-bezier(0.390, 0.575, 0.565, 1.000) both;
                animation: fade-in-bottom 0.6s cubic-bezier(0.390, 0.575, 0.565, 1.000) both;
    }

    @-webkit-keyframes fade-in-bottom {
        0% {
            -webkit-transform: translateY(50px);
                    transform: translateY(50px);
            opacity: 0;
        }
        100% {
            -webkit-transform: translateY(0);
                    transform: translateY(0);
            opacity: 1;
        }
    }
    @keyframes fade-in-bottom {
        0% {
            -webkit-transform: translateY(50px);
                    transform: translateY(50px);
            opacity: 0;
        }
        100% {
            -webkit-transform: translateY(0);
                    transform: translateY(0);
            opacity: 1;
        }
    }

    .card-title{
        font-size: 1rem;
        line-height: 1;
    }
    .card-title-total{
        font-size: 3rem;
        line-height: 1;
    }
    /*// Small devices (landscape phones, 576px and up)*/
    @media (min-width: 576px) {

    }

    /*// Medium devices (tablets, 768px and up)*/
    @media (min-width: 768px) {
        .card-title{
            font-size: 1.5rem;
        }
    }

    /*// Large devices (desktops, 992px and up)*/
    @media (min-width: 992px) {

    }

    /*// Extra large devices (large desktops, 1200px and up)*/
    @media (min-width: 1200px) {

    }
</style>
