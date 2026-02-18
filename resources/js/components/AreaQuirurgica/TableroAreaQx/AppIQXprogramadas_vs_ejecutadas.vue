<template>
    <div class="w-100 glassmod-effect rounded-custom-1 d-flex flex-column  justify-content-between" >
        <div class="font-weight-bold h5 pl-3 mt-1 text-uppercase">
            IQX Programadas vs Ejecutadas
        </div>
        <div class="px-4 overflow-auto" style="width: 100%;">
            <canvas id="grafico1" height="400"></canvas>
        </div>
        <div class="container">
            <table class="w-100 mx-2 mt-2">
                <thead>
                    <tr style="border-bottom: 1px solid rgba(0, 0, 0, .125);">
                        <th style="width:60%">IQX</th>
                        <th class="text-center px-2">Programadas</th>
                        <th class="text-center px-2">Ejecutadas</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th style="width:70%">
                            <div class="d-flex align-items-center my-1">
                                <div style="line-height:1.1" class="d-flex flex-column">
                                    <div>Total IXQ</div>
                                </div>
                            </div>
                        </th>
                        <td class="text-center h4">
                            {{ total_por_ejecutar_hospitalizacion }}
                        </td>
                        <td class="text-center h4">
                            {{ item_ejecutado_total }}
                        </td>
                    </tr>
                    <!-- <tr>
                        <th style="width:70%">
                            <div class="d-flex align-items-center my-1">
                                <div style="line-height:1.1" class="d-flex flex-column">
                                    <div>Total IXQ</div>
                                </div>
                            </div>
                        </th>
                        <td class="text-center h4">
                            {{ total_por_ejecutar_hospitalizacion }}
                        </td>
                        <td class="text-center h4">
                            {{ item_ejecutado_total }}
                        </td>


                    </tr> -->
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    name: "AppIQXprogramadas_vs_ejecutadas",
    props: {
        fecha_desde: String,
        fecha_hasta: String,
        item_ejecutado_total: Number,
        total_por_ejecutar_hospitalizacion: Number,
    },
    data() {
        return {
            myChart: null
        }
    },

    watch: {
        item_ejecutado_total: {
            immediate: false, // Ejecuta la función de inmediato al montar el componente
            handler(nuevosDatos) {
                //console.log("--->",this.myChart );
                if (this.myChart !== null) {
                    // Actualiza el gráfico con los nuevos datos
                    this.myChart.data.datasets[1].data = [nuevosDatos];
                    this.myChart.update();
                }

            }
        },
        total_por_ejecutar_hospitalizacion: {
            immediate: false, // Ejecuta la función de inmediato al montar el componente
            handler(nuevosDatos) {
                // Actualiza el gráfico con los nuevos datos
                if (this.myChart !== null) {
                    this.myChart.data.datasets[0].data = [nuevosDatos];
                    this.myChart.update();
                }
            }
        },
        fecha_desde: {
            immediate: false, // Ejecuta la función de inmediato al montar el componente
            handler(nuevosDatos) {
                // Actualiza el gráfico con los nuevos datos
                if (this.myChart !== null) {
                    this.myChart.data.labels = ["Desde el "+nuevosDatos+" hasta "+this.fecha_hasta+""];
                    this.myChart.update();
                }
            }
        },
        fecha_hasta: {
            immediate: false, // Ejecuta la función de inmediato al montar el componente
            handler(nuevosDatos) {
                // Actualiza el gráfico con los nuevos datos
                if (this.myChart !== null) {
                    this.myChart.data.labels = ["Desde el "+this.fecha_desde+" hasta "+nuevosDatos+""];
                    this.myChart.update();
                }
            }
        },
    },
    mounted() {
        Chart.register(ChartDataLabels);
        let that = this

        // Crear un gráfico de línea
        setTimeout(() => {
            const ctx = document.getElementById('grafico1').getContext('2d');
            that.myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ["Desde el "+this.fecha_desde+" hasta "+this.fecha_hasta+""], // Etiquetas para los puntos del gráfico
                    datasets: [
                    {
                            label: 'IQX Programadas',
                            data: [that.total_por_ejecutar_hospitalizacion],
                            backgroundColor: 'rgba(50, 181, 103, 1)',
                            borderColor: 'rgba(50, 181, 103, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Ejecutadas',
                            data: [that.item_ejecutado_total],
                            backgroundColor: 'rgba(95, 130, 194, 1)',
                            borderColor: 'rgba(95, 130, 194, 1)',
                            borderWidth: 1
                        },

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
