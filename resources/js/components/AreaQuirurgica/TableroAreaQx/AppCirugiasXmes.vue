<template>
    <div class="flex-fill glassmod-effect rounded-custom-1 overflow-auto d-flex flex-column">
        <div class="font-weight-bold h5 pl-3 mt-1 text-uppercase">
            Consolidado de IQX Ejecutadas <b>{{ fechasFormat }}</b>
        </div>
        <div>
            <div class="px-4 overflow-auto" style="width: 100%;">
                <canvas id="grafico4"></canvas>
            </div>
            <div class="px-4 pb-1">
                <table class="w-100">
                    <thead>
                        <tr style="border-bottom: 1px solid rgba(0, 0, 0, 0.125);">
                            <td style="border-right: 1px solid rgba(0, 0, 0, 0.125);">Mes</td>
                            <th class="text-center">ENE</th>
                            <th class="text-center">FEB</th>
                            <th class="text-center">MAR</th>
                            <th class="text-center">ABR</th>
                            <th class="text-center">MAY</th>
                            <th class="text-center">JUN</th>
                            <th class="text-center">JUL</th>
                            <th class="text-center">AGO</th>
                            <th class="text-center">SEP</th>
                            <th class="text-center">OCT</th>
                            <th class="text-center">NOV</th>
                            <th class="text-center">DIC</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="border-bottom: 1px solid rgba(0, 0, 0, 0.125);">
                            <td style="border-right: 1px solid rgba(0, 0, 0, 0.125);">Total {{ anioActual }}</td>
                            <td
                                :title="'Total'+ item.total_actual !==0 ? item.total_actual : 'No disponible'"
                                style="border-right: 1px solid rgba(0, 0, 0, 0.125);"
                                v-for="(item,index) in dataset" :key="'medicolist_'+index"
                                class="text-center"
                            >
                                {{ item.total_actual }}
                            </td>

                        </tr>
                        <tr style="border-bottom: 1px solid rgba(0, 0, 0, 0.125);">
                            <td style="border-right: 1px solid rgba(0, 0, 0, 0.125);">Total {{ anioAnterior }}</td>
                            <td
                                :title="'Total'+ item.total_anterior !==0 ? item.total_anterior : 'No disponible'"
                                style="border-right: 1px solid rgba(0, 0, 0, 0.125);"
                                v-for="(item,index) in dataset" :key="'medicolist_'+index"
                                class="text-center"
                            >
                                {{ item.total_anterior }}
                            </td>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import { mesesEnEspanol, post,fechaAMD,fechaDMA, fechaCustom2,capitalizarPrimeraLetra, timestamps, fechaHoy } from "../../../helpers/customHelpers.js"

export default {
    name: "AppCirugiasXmes",
    props: {
        dataset: Array,
        fecha_desde:String,
        fecha_hasta:String,
    },
    data() {
        let fecha = new Date()
        return {
            anioActual:fecha.getFullYear(),
            anioAnterior:fecha.getFullYear()-1,
            midataset:[],
            myChart: null
        }
    },
    computed: {
        fechasFormat() {
            let fecha_inicio = this.fecha_desde.split("-")
            let fecha_fin = this.fecha_hasta.split("-")
            //alert(fecha_inicio.getFullYear() +"-"+ fecha_fin.getFullYear() )
            let result = ""
                if  (
                        Number(fecha_inicio[0]) === Number(fecha_fin[0])
                    )
                {



                    if  (
                        Number(fecha_inicio[1]) === Number(fecha_fin[1])
                    )
                    {
                        //MES
                        result = `${capitalizarPrimeraLetra(mesesEnEspanol[ Number(fecha_inicio[1])-1 ].slice(0,3))} - ${ Number(fecha_inicio[0]) }`
                    }

                }

             /*    result = fecha_inicio.getFullYear() === fecha_fin.getFullYear()
                ? `${capitalizarPrimeraLetra(mesesEnEspanol[fecha_inicio.getMonth()+1].slice(0,3))} - ${capitalizarPrimeraLetra(mesesEnEspanol[fecha_fin.getMonth()].slice(0,3))} ${ fecha_inicio.getFullYear()}`
                : `${mesesEnEspanol[fecha_inicio.getMonth()+1].slice(0,3)} ${ fecha_inicio.getFullYear()} - ${mesesEnEspanol[fecha_fin.getMonth()].slice(0,3)} ${ fecha_fin.getFullYear()}`

                result = fecha_inicio.getFullYear() === fecha_fin.getFullYear() && fecha_inicio.getMonth()+1 === fecha_fin.getMonth()+1
                ? `${capitalizarPrimeraLetra(mesesEnEspanol[fecha_inicio.getMonth()+1].slice(0,3))} - ${capitalizarPrimeraLetra(mesesEnEspanol[fecha_fin.getMonth()].slice(0,3))} ${ fecha_inicio.getFullYear()}`
                : `${mesesEnEspanol[fecha_inicio.getMonth()+1].slice(0,3)} ${ fecha_inicio.getFullYear()} - ${mesesEnEspanol[fecha_fin.getMonth()].slice(0,3)} ${ fecha_fin.getFullYear()}` */
            return result
        }
    },
    watch: {
        dataset: {
            immediate: false, // Ejecuta la función de inmediato al montar el componente
            handler(nuevosDatos) {
                //console.log("2------------->",nuevosDatos.map(x=>x.total));
                if (this.myChart !== null) {
                    // Actualiza el gráfico con los nuevos datos

                    this.myChart.data.datasets[0].data = nuevosDatos.map(x=>x.total_actual);
                    this.myChart.data.datasets[1].data = nuevosDatos.map(x=>x.total_anterior);
                    /* this.myChart.data.datasets[1].data = nuevosDatos.map(x=>x.total_en_hora);
                    this.myChart.data.datasets[2].data = nuevosDatos.map(x=>x.total_deshora); */
                    this.myChart.update();
                }

            }
        },


    },
    mounted() {
        Chart.register(ChartDataLabels);
        let that = this

        let fecha = new Date()
            //console.log("1------------->",that.dataset );
        // Crear un gráfico de línea
        setTimeout(() => {
            const ctx = document.getElementById('grafico4').getContext('2d');
            that.myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['ENE', 'FEB', 'MAR', 'ABR', 'MAY', 'JUN', 'JUL',"AGO","SEP","OCT","NOV","DIC"],
                    datasets: [
                        {
                            label: 'IQX Ejecutadas en '+fecha.getFullYear(),
                            data: that.dataset.map(x=>x.total_actual) ,
                            backgroundColor: 'rgba(50, 181, 103, 0.5)',
                            borderColor: 'rgba(50, 181, 103, 1)',
                            fill: false
                        },
                        {
                            label: 'IQX Ejecutadas en '+(fecha.getFullYear()-1),
                            data: that.dataset.map(x=>x.total_anterior) ,
                            backgroundColor: 'rgba(95, 130, 194, 0.3)',
                            borderColor: 'rgba(95, 130, 194, 1)',
                            fill: false
                        },
                        /* {
                            label: 'IQX En hora',
                            data: that.dataset.map(x=>x.total_en_hora),
                            backgroundColor: 'rgba(95, 130, 194, 0.3)',
                            borderColor: 'rgba(95, 130, 194, 1)',
                            fill: false
                        },
                        {
                            label: 'IQX Con retraso',
                            data: that.dataset.map(x=>x.total_en_hora),
                            backgroundColor: 'rgba(255, 138, 138, 0.3)',
                            borderColor: 'rgba(255, 138, 138, 1)',
                            fill: false
                        }, */
                    ]
                },
                options: {

                    plugins: {
                        datalabels: {
                            align: 'center',
                            anchor: 'center',
                            color: "white",
                            fontSize: "100px"
                        },
                        legend: {
                            labels: {
                                color: 'white' // Cambia el color de las leyendas
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                color: 'rgba(255, 255, 255, 0.40)' // Cambia el color de la cuadrícula de fondo en el eje Y
                            },
                            ticks: {
                                color: 'white' // Cambia el color de las etiquetas en el eje X
                            }
                        },
                        y: {
                            grid: {
                                color: function (context) {
                                    /* if (context.tick.value === 45) {//METAS
                                        return "rgba(255, 165, 0, 0.80)";
                                    } */
                                    return 'rgba(255, 255, 255, 0.40)';// Cambia el color de la cuadrícula de fondo en el eje Y
                                },
                            },
                            ticks: {
                                //max:1000,
                                color: 'white', // Cambia el color de las etiquetas en el eje X
                            }
                        },

                    },
                }
            });
        }, 500);
    }
}
</script>

<style lang="scss" scoped></style>
