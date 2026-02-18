<template>
    <div class="w-100 glassmod-effect rounded-custom-1 d-flex flex-column justify-content-between">
            <div class="font-weight-bold h5 pl-3 mt-1 text-uppercase">
                Total IQX Ejecutadas por Turnos Horarios
            </div>
            <div class="px-4 overflow-auto" style="width: 100%;">
                <canvas id="grafico3" height="400"></canvas>
            </div>
            <div class="px-1">
                <table class=" w-100">
                    <thead>
                        <tr style="border-bottom: 1px solid rgba(0, 0, 0, 0.125);">
                            <th style="width: 70%;">Turno</th>
                            <th class="text-center">Total IXQ</th>
                            <th class="text-center">%</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="border-bottom: 1px solid rgba(0, 0, 0, 0.125);">
                            <td class="text-uppercase" colspan="3">
                                Lunes a Viernes
                            </td>
                        </tr>
                        <tr v-for="(item,index) in dataset.filter((x,index)=>[0,1,2].includes(index))" :key="'medicolist_'+index" style="border-bottom: 1px solid rgba(0, 0, 0, 0.125);">
                            <td>
                                <div class="ml-1 d-flex flex-column" style="line-height: 1.1;">
                                    {{ item.turno }}

                                </div>
                            </td>
                            <td class="text-center h4">
                                {{ item.total }}
                            </td>
                            <td style="font-size:1rem;" class="text-center">
                                {{ getPorcentaje(item.total) }}%
                            </td>
                        </tr>
                        <tr style="border-bottom: 1px solid rgba(0, 0, 0, 0.125);">
                            <td class="text-uppercase" colspan="3">
                                Sábados
                            </td>
                        </tr>
                        <tr v-for="(item,index) in dataset.filter((x,index)=>[3,4,5].includes(index))" :key="'medicolist_'+index" style="border-bottom: 1px solid rgba(0, 0, 0, 0.125);">
                            <td>
                                <div class="ml-1 d-flex flex-column" style="line-height: 1.1;">
                                    {{ item.turno }}

                                </div>
                            </td>
                            <td class="text-center h4">
                                {{ item.total }}
                            </td>
                            <td style="font-size:1rem;" class="text-center">
                                {{ getPorcentaje(item.total) }}%
                            </td>
                        </tr>
                        <tr style="border-bottom: 1px solid rgba(0, 0, 0, 0.125);">
                            <td class="text-uppercase" colspan="3">
                                Domingo
                            </td>
                        </tr>
                        <tr v-for="(item,index) in dataset.filter((x,index)=>[6,7,8].includes(index))" :key="'medicolist_'+index" style="border-bottom: 1px solid rgba(0, 0, 0, 0.125);">
                            <td>
                                <div class="ml-1 d-flex flex-column" style="line-height: 1.1;">
                                    {{ item.turno }}

                                </div>
                            </td>
                            <td class="text-center h4">
                                {{ item.total }}
                            </td>
                            <td style="font-size:1rem;" class="text-center">
                                {{ getPorcentaje(item.total) }}%
                            </td>
                        </tr>
                        <tr style="border-bottom: 1px solid rgba(0, 0, 0, 0.125);">
                            <th class="text-uppercase">
                                Total IQX
                            </th>
                            <td class="text-center h4">{{ getTotalIqx() }}</td>
                            <td>100%</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
</template>

<script>
export default {
    name: "AppTurnosHorariosMasUtilizados",
    props: {
        dataset: Array,
    },
    data() {
        return {
            myChart: null
        }
    },
    methods: {
        getTotalIqx(){
            return this.dataset.map(x=>Number(x.total)).reduce((acumulador, valorActual) => {
                    return acumulador + valorActual;
                }, 0)
        },
        getPorcentaje(item){
            let result = item * 100 / this.getTotalIqx()
                result = !Number.isNaN( result )
                    ? result.toFixed(0)
                    : 0
            return result
        },
    },
    watch: {
        dataset: {
            immediate: true, // Ejecuta la función de inmediato al montar el componente
            handler(nuevosDatos) {
                // Actualiza el gráfico con los nuevos datos
                if (this.myChart !== null) {
                this.myChart.data.datasets[0].data = nuevosDatos.map(x=>x.total);
                this.myChart.update();
                }
            }
        },


    },
    mounted() {
        Chart.register(ChartDataLabels);
        let that = this

            console.log();
        // Crear un gráfico de línea
        setTimeout(() => {


            const ctx = document.getElementById('grafico3').getContext('2d');
            that.myChart = new Chart(ctx, {
                type: 'pie',
                data: {
                labels: ["LV-AM","LV-PM","LV-MAD","SAB-AM","SAB-PM","SAB-MAD","DOM-AM","DOM-PM","DOM-MAD"], // Etiquetas para los puntos del gráfico
                datasets: [
                    {
                    data: [0,0,0,0,0,0,0,0,0],
                    backgroundColor: [
                        'rgba(95, 130, 194, 1)',
                        'rgba(50, 181, 103, 1)',
                        'rgba(54, 99, 156, 1)',
                        'rgba(170, 127, 255, 1)',
                        'rgba(14, 154, 167, 1)',
                        'rgba(61, 187, 171, 1)',
                        'rgba(246, 205, 97, 1)',
                        'rgba(254, 138, 113, 1)'
                    ],
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
        }, 500);
    },
}
</script>

<style lang="scss" scoped></style>
