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
                            <script defer src="{{ mix('js/consumptiondiagramm.js') }}"></script>

                        </div>
                    </div>
                    <p><br></p>
                </div>
            </div>


        </div>
    </div>
@endsection
