<template>
    <div class="flex-fill p-1 d-flex flex-column overflow-auto" >

        <CintilloModal :index_row="index_row" :dataPaciente="dataPaciente" />
        <div class="flex-fill mt-1 rounded bg-danger overflow-auto">
            {{ index_row }}
            {{ dataPaciente }}
        </div>
        <div class="rounded d-flex mt-1">
            <button @click="submit()" id="submit" class="flex-fill btn btn-success mr-1">
                Reingresar paciente
            </button>
            <button class="flex-fill btn btn-primary"   data-dismiss="modal" aria-label="Close">
                Cancelar
            </button>

        </div>

    </div>
</template>

<script>
    import CintilloModal from './CintilloModal.vue';
    export default {
        name:"BtnWidgetHistoriaInicialPaciente",
        props:{
            index_row:Number,
            dataPaciente:Object
        },
        components: {
            CintilloModal
        },
        data() {
            return {

            }
        },
        methods: {

        },
        mounted() {

            }
    }
</script>

<style scoped>

    .bg-transparent{
        background-color: transparent !important;
        border:0px !important
    }
    .btn-default-custom {
        background-color: transparent;
    }
    .btn-default-custom:hover {
        background-color: #e2e2e2;
    }
    .heartbeat:hover {
        -webkit-animation: heartbeat 1.5s ease-in-out infinite both;
        animation: heartbeat 1.5s ease-in-out infinite both
    }

    @-webkit-keyframes heartbeat {
        from {
            -webkit-transform: scale(1);
            transform: scale(1);
            -webkit-transform-origin: center center;
            transform-origin: center center;
            -webkit-animation-timing-function: ease-out;
            animation-timing-function: ease-out
        }
        10% {
            -webkit-transform: scale(.91);
            transform: scale(.91);
            -webkit-animation-timing-function: ease-in;
            animation-timing-function: ease-in
        }
        17% {
            -webkit-transform: scale(.98);
            transform: scale(.98);
            -webkit-animation-timing-function: ease-out;
            animation-timing-function: ease-out
        }
        33% {
            -webkit-transform: scale(.87);
            transform: scale(.87);
            -webkit-animation-timing-function: ease-in;
            animation-timing-function: ease-in
        }
        45% {
            -webkit-transform: scale(1);
            transform: scale(1);
            -webkit-animation-timing-function: ease-out;
            animation-timing-function: ease-out
        }
    }

    @keyframes heartbeat {
        from {
            -webkit-transform: scale(1);
            transform: scale(1);
            -webkit-transform-origin: center center;
            transform-origin: center center;
            -webkit-animation-timing-function: ease-out;
            animation-timing-function: ease-out
        }
        10% {
            -webkit-transform: scale(.91);
            transform: scale(.91);
            -webkit-animation-timing-function: ease-in;
            animation-timing-function: ease-in
        }
        17% {
            -webkit-transform: scale(.98);
            transform: scale(.98);
            -webkit-animation-timing-function: ease-out;
            animation-timing-function: ease-out
        }
        33% {
            -webkit-transform: scale(.87);
            transform: scale(.87);
            -webkit-animation-timing-function: ease-in;
            animation-timing-function: ease-in
        }
        45% {
            -webkit-transform: scale(1);
            transform: scale(1);
            -webkit-animation-timing-function: ease-out;
            animation-timing-function: ease-out
        }
    }
</style>
