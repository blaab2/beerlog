@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Drink Overview</div>
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="card-body">
                        <canvas id="myChart" width="400" height="150"></canvas>
                        <div class="table-responsive-md">
                            <table class="table table-dark" id="table-user-index">
                                <thead>
                                <tr>
                                    <th scope="col">id</th>
                                    <th scope="col">date</th>
                                    <th scope="col">type</th>
                                    <th scope="col">price</th>
                                </tr>
                                </thead>
                                <tbody>


                                </tbody>
                            </table>
                            <input type="hidden" id="data" value="{{$beers->toJson()}}"/>
                            <script>
                                $(document).ready(function () {
                                    var data = JSON.parse($("#data").val());


                                    var counts = _.countBy(data, function (date) {
                                        return moment(date.created_at).startOf('day').format();
                                    });


                                    var diagrammdata = [];

                                    for (var prop in counts) {
                                        diagrammdata.push({'t': moment(prop), 'y': counts[prop]});
                                    }


                                    var timeFormat = 'DD/MM/YYYY';

                                    var ctx = document.getElementById('myChart');


                                    var timeFormat = 'DD/MM/YYYY';

                                    var config = {
                                        type: 'bar',
                                        data: {
                                            datasets: [
                                                {
                                                    label: "Consumption",
                                                    data: diagrammdata,
                                                    fill: true,
                                                    backgroundColor: '#00bc8c',
                                                    borderColor: '#00bc8c'
                                                }
                                            ]
                                        },
                                        options: {
                                            responsive: true,
                                            legend: {
                                                display: true,
                                                labels: {
                                                    fontColor: '#fff'
                                                }
                                            },
                                            scales: {
                                                xAxes: [{
                                                    type: "time",
                                                    time: {
                                                        format: timeFormat
                                                    },
                                                    scaleLabel: {
                                                        display: true,
                                                        labelString: 'Date'
                                                    },
                                                    ticks: {
                                                        fontColor: '#fff'
                                                    }
                                                }],
                                                yAxes: [{
                                                    scaleLabel: {
                                                        display: true,
                                                        labelString: 'Drinks'
                                                    },
                                                    ticks: {
                                                        fontColor: '#fff'
                                                    }
                                                }]
                                            },
                                            plugins: {
                                                datalabels: {
                                                    display: false,
                                                },
                                            }
                                        }
                                    };

                                    var chart = new Chart(ctx, config);
                                    $('#table-user-index').DataTable({
                                        data: data,
                                        columns: [
                                            {data: 'id'},
                                            {
                                                data: 'created_at', render: function (data, type, row) {
                                                    return window.moment(data).format("YYYY-MM-DD HH:mm:ss");
                                                }
                                            },
                                            {data: 'beer_type.name'},
                                            {data: 'cost'}
                                        ],

                                        "order": [[0, "desc"]]
                                    });

                                });
                            </script>
                        </div>
                    </div>
                    <p><br></p>
                </div>
            </div>


        </div>
    </div>
@endsection
