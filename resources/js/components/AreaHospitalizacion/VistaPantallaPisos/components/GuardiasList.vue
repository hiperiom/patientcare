<template>
    <div v-if="list_guardias.length > 0" class="text-white d-flex flex-column">
        <h5 class="text-center text-uppercase">Personal de Guardia</h5>
        <div class="flex-fill gap-1 d-flex justify-content-center flex-wrap p-1 overflow-auto"
            style="max-height: 10rem;">
            <div v-for="(item, index) in list_guardias" :key="'guardias' + index"
                class="flex-grow-1 flex-sm-grow-0 flex-sm-shrink-1 d-flex flex-column rounded border border-white p-1">
                <h6 class="font-weight-bold mb-0">{{ item.cargo }}</h6>
                <div class="d-flex align-items-center ">
                    <img loading="lazy" onerror="this.src='/image/system/patient.svg'" :src="item.imagen"
                        class="img-doctor mr-1"
                        style="width: 35px; height: 35px; border-radius: 20px;">


                    <div class="d-flex flex-column" style="line-height: 1.5rem;">
                        <div class="text-nowrap overflow-hidden"
                            style="width: auto !important; text-transform: capitalize !important;">

                            {{ item.personal }}
                            <!-- <div class="badge ml-1  badge-warning">EN</div> -->
                        </div>
                        <div class="d-flex">
                            <div class="mr-1 badge badge-warning"
                                style="font-size: 0.7rem; padding: 0.2rem; font-weight: 400;"><i
                                    class="fas fa-phone-alt"></i> {{ item.asterisco }}

                            </div>
                        </div>
                    </div>

                </div>
            </div>



        </div>
    </div>

</template>

<script>
    import { get, post, is_null, horaPm, meses, fechaHoy, mesesEnEspanol, formatAMPM, obtenerVariablesGET } from '../../../../helpers/customHelpers?00001';

    export default {
        name: "GuardiasList",
        data() {
            return {
                list_guardias: [
                    {},
                    {},
                    {},
                    {},
                    {},
                    {},
                    {},
                    {},
                    {},
                    {},
                    {},
                ]
            }
        },
        methods: {
            async getGuardias() {
                let formData = new FormData();
                formData.append("_token", document.querySelector('meta[name="csrf-token"]').getAttribute('content'))
                this.list_guardias = await post("/guardias/today_list", formData)
            },
        },
        async mounted() {
            let that = this
            await that.getGuardias()
            setInterval(async () => {
                await that.getGuardias()
            }, 10000);
        },
    }
</script>

<style lang="scss" scoped>
    .gap-1 {
        gap: 0.5rem;
    }

    /*    body {
        font-family: Arial, sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        background-color: #f0f0f0;
    } */

    /*     .marquee {
        width: 100%;
        overflow: hidden;
        white-space: nowrap;
        box-sizing: border-box;
    }

    .marquee p {
        display: inline-block;
        padding-left: 100%;
        animation: marquee 1s linear infinite;
        animation-duration: 20s;
    }

    @keyframes marquee {
        0% {
            transform: translateX(100%);
        }

        100% {
            transform: translateX(-100%);
        }
    } */
</style>
