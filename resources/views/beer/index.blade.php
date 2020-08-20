@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Drinks History (2 month, {{$user_label}})</div>
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
                        <div class="row">
                            <div class="col-12">
                                <canvas id="consumptionChart" width="400" height="150"></canvas>
                            </div>
                        </div>
                        <div class="row pb-4">
                            <div class="col-lg-3 col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-subtitle mb-2 text-muted">last 2 month, {{$user_label}}</h6>
                                        <canvas id="pieChart1" width="80" height="80"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
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
                                </div>
                            </div>

                        </div>
                    </div>
                    <p><br></p>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive-md">
                                    <table id="example" class="table table-dark" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>date</th>
                                            <th>price</th>
                                            <th>type</th>
                                        </tr>
                                        </thead>
                                    </table>
                                    <p><br></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        $(document).ready(function () {
                            $('#example').DataTable({
                                "processing": true,
                                "serverSide": true,
                                "ajax": {
                                    "url": "{{ url('beers2') }}",
                                    "dataType": "json",
                                    "type": "POST",
                                    "data": {_token: "{{csrf_token()}}"}
                                },
                                "columns": [
                                    {"data": "id"},
                                    {
                                        "data": "created_at", render: function (data, type, row) {
                                            return window.moment(data).format("YYYY-MM-DD HH:mm:ss");
                                        }
                                    },
                                    {"data": "cost"},
                                    {"data": "beer_type.name", "orderable": false}
                                ]

                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ mix('js/consumptiondiagramm.js') }}"></script>
@endsection
