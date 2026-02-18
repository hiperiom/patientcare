@extends('component.template')

@section('title')
    CMDLT | PatientCare
@endsection
@section('header')
    @include('component.menu_principal')
@endsection
@section('menu_2')
    @if (!is_null(session('userData')))
        @include('component.menu_user')
    @endif
@endsection
@section('content')
    @yield('menu_2')
    <div class="content-wrapper">
        <div class="wrapper">
            <div id="content_1" >
                <div class="d-flex m-4 justify-content-center text-primary">
                    Cargando...
                    <div class="spinner-border" role="status">
                        <span class="sr-only"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
@section('footer')
    @include('component.menu_footer')
@endsection
@section('script')
    <script>
        class Vista {
            static v_lts_oxit(selector,data){
                $(selector).html(`
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <h1 class="text-primary">
                                    Total Oxígeno aplicado en Oxigenoterapia
                                </h1>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <div id="grafico">
                                    <canvas id="myChart" style="height:300px; width:100%;border:1px solid var(--light)"></canvas>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="text-center" rowspan="2" nowrap>Ubicación</th>
                                                <th class="text-center" rowspan="2" nowrap>Paciente</th>
                                                <th class="text-center" rowspan="2" nowrap>Sexo</th>
                                                <th class="text-center" rowspan="2" nowrap>Edad</th>
                                                <th class="text-center" colspan="3">Lítros</th>
                                            </tr>
                                            <tr>
                                                <th class="text-center" nowrap>1 a 5</th>
                                                <th class="text-center" nowrap>6 a 10</th>
                                                <th class="text-center" nowrap>> a 10</th>
                                            </tr>
                                        </thead>
                                        <tbody id="resultModel">
                                            <tr>
                                                <td colspan="7">
                                                    <div class="d-flex m-4 justify-content-center text-primary">
                                                        Cargando...
                                                        <div class="spinner-border" role="status">
                                                            <span class="sr-only"></span>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="4">TOTALES</th>
                                                <th><div id="total1">1</div></th>
                                                <th><div id="total2">2</div></th>
                                                <th><div id="total3">3</div></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                `);
                let model = "";
                let sumRango1 = 0;
                let sumRango2 = 0;
                let sumRango3 = 0;
                $.each(data.model, function (indexInArray, valueOfElement) {
                    console.log(valueOfElement)
                    sumRango1 += valueOfElement['rango1']==""?0:parseInt(valueOfElement['rango1']);
                    sumRango2 += valueOfElement['rango2']==""?0:parseInt(valueOfElement['rango2']);
                    sumRango3 += valueOfElement['rango3']==""?0:parseInt(valueOfElement['rango3']);
                    model +=`
                        <tr>
                            <td>
                                ${valueOfElement['ubicacion']}
                            </td>
                            <td>
                                ${valueOfElement['paciente']}
                            </td>
                            <td class="text-center">
                                ${valueOfElement['sexo']}
                            </td>
                            <td class="text-center">
                                ${valueOfElement['edad']}
                            </td>
                            <td class="text-center">
                                ${valueOfElement['rango1']}
                            </td>
                            <td class="text-center">
                                ${valueOfElement['rango2']}
                            </td>
                            <td class="text-center">
                                ${valueOfElement['rango3']}
                            </td>
                        </tr>
                    `;
                });

                $("#resultModel").html(model);
                $("#total1").html(sumRango1);
                $("#total2").html(sumRango2);
                $("#total3").html(sumRango3);
                var ctx = document.getElementById('myChart').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['1 a 5', '6 a 10', '> a 10'],
                        datasets: [{
                            label: '# Litros',
                            data: [sumRango1, sumRango2, sumRango3],
                            backgroundColor: [
                                '#2fa60099',
                                '#fd7e1478',
                                '#dc35457a'

                            ],
                            borderColor: [
                                '#28a745',
                                '#fd7e14',
                                '#DC3545'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        legend: {
                            display: false
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            }
        }
        $(document).ready( function () {
            var model = @json($model, JSON_PRETTY_PRINT);
            Vista.v_lts_oxit("#content_1",{"model":model})
        });
    </script>
@endsection
@section('css')
    <style>

    </style>
@endsection
