<template>
    <div class="w-100 glassmod-effect rounded-custom-1  d-flex flex-column justify-content-between">
        <div class="font-weight-bold h5 pl-3 mt-1 text-uppercase">
            Tipos de Cirugías Ejecutadas
        </div>
        <div class="px-4 overflow-auto" style="width: 100%;">
            <canvas id="grafico2" height="400"></canvas>
        </div>
        <div class="container">
            <table class="w-100">
            <thead>
                <tr style="border-bottom: 1px solid rgba(0, 0, 0, .125);">
                <th style="width:70%">IQX</th>
                <th class="text-center text-nowrap px-2">Total</th>
                <th class="text-center">Porcentaje</th>
                </tr>
            </thead>
            <tbody>
                <tr style="border-bottom: 1px solid rgba(0, 0, 0, .125);">
                <td>
                    <div class="d-flex align-items-center my-1">
                    <div style="line-height:1.1" class="ml-1 d-flex flex-column">
                        <div>Emergencia</div>
                    </div>
                    </div>
                </td>
                <td class="text-center h4">
                    {{dataset[0]}}
                </td>
                <td class="text-center">
                    {{ Math.round(dataset[0] * 100 / (dataset[0] + dataset[1]))}}%
                </td>
                </tr>
                <tr style="border-bottom: 1px solid rgba(0, 0, 0, .125);">
                    <td>
                        <div class="d-flex align-items-center my-1">
                        <div style="line-height:1.1" class="ml-1 d-flex flex-column">
                            <div>Electivas</div>
                        </div>
                        </div>
                    </td>
                    <td class="text-center h4">
                        {{dataset[1]}}
                    </td>
                    <td class="text-center">
                        {{ Math.round(dataset[1] * 100 / (dataset[0] + dataset[1]))}}%
                    </td>
                </tr>
                <tr style="border-bottom: 1px solid rgba(0, 0, 0, .125);">
                    <td>
                        <div class="d-flex align-items-center my-1">
                        <div style="line-height:1.1" class="ml-1 d-flex flex-column">
                            <div>Total</div>
                        </div>
                        </div>
                    </td>
                    <td class="text-center">
                        {{dataset[0] +dataset[1]}}
                    </td>
                    <td class="text-center">
                        100%
                    </td>
                </tr>



            </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        name:"AppTipoCirugia",
        props: {
            fecha_desde: String,
            fecha_hasta: String,
            dataset: Array,
        },
        data() {
            return {
                myChart: null
            }
        },
        watch: {
            dataset: {
                immediate: true, // Ejecuta la función de inmediato al montar el componente
                handler(nuevosDatos) {
                    // Actualiza el gráfico con los nuevos datos
                    if (this.myChart !== null) {
                    this.myChart.data.datasets[0].data = nuevosDatos;
                    this.myChart.update();
                    }
                }
            },


        },
        methods: {
            getPorcentaje(item){
                let result = item * 100 / this.item_total
                    result = !Number.isNaN( result )
                        ? result.toFixed(0)
                        : 0
                return result
            },
        },
        mounted(){
            let that = this
            Chart.register(ChartDataLabels);
            setTimeout(() => {


                const ctx = document.getElementById('grafico2').getContext('2d');
                that.myChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                    labels: ["Emergencia","Electiva"], // Etiquetas para los puntos del gráfico
                    datasets: [
                        {
                        data: that.dataset,
                        backgroundColor: ['rgba(95, 130, 194, 1)','rgba(50, 181, 103, 1)'],
                        borderColor: 'rgba(00, 00, 000, 0)',
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
                        },
                        legend: {
                            labels: {
                                color: 'white' // Cambia el color de las leyendas
                            }
                        }
                    },
                    scales: {

                    }
                    }
                });
            }, 1000);
        }
    }
</script>

<style lang="scss" scoped>

</style>
