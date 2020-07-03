@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="row justify-content-center">
                            <div class="col-sm-4 py-1">
                                {!! Form::open(['route' => ['addbeer']]) !!}
                                {!! Form::rawSubmitBtn('One Beer please! <i class="fas fa-beer"></i>',['class' => 'btn btn-lg btn-info w-100']) !!}
                                {!! Form::close() !!}
                            </div>
                            <div class="col-sm-4 py-1">
                                {!! Form::open(['route' => ['addbeer']]) !!}
                                {!! Form::hidden('count', 2) !!}
                                {!! Form::rawSubmitBtn('Two Beer please! <i class="fas fa-beer"></i><i class="fas fa-beer"></i>',['class' => 'btn btn-lg btn-info w-100']) !!}

                                {!! Form::close() !!}
                            </div>
                            <div class="col-sm-4 py-1">
                                <a class="btn btn-lg btn-info w-100"
                                   onclick="swalbeerdialog('{{route('addbeer')}}',20); return false;" href="#">Crate
                                    please!!!
                                    20x<i class="fas fa-beer"></i></a>
                            </div>
                        </div>
                            <div class="row justify-content-center">The price for one beer
                                is {{number_format($beer_price,2)}}€ at the
                                moment.
                            </div>
                            <hr/>
                            <div class="row justify-content-center">

                            </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center d-flex align-items-stretch">
            <div class="col-lg-3">
                <div class="card h-100">
                    <div class="card-header">Stats</div>
                    <div class="card-body"><p>
                            nickname: {{$user->nickname}}</p>
                        <p>
                            total beer count: {{$user->total_beers_count}}<br>
                            recent beer count: {{$user->beers_count}}</p>
                        <p>
                            payed: {{$user->cashflow}}€<br>
                            debts: {{$user->depts}}€<br>
                            total: <span @if($user->cashflow-$user->depts<0)class="text-warning"@endif>
                            {{$user->cashflow-$user->depts}}€</span></p>
                        <p>
                            Last beer registered:<br>{{$beers->first()->created_at}}
                        </p>
                    </div>
                </div>

            </div>
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-header">Recent Beer Ranking</div>
                    <input type="hidden" id="data1" value="{{$users->toJson()}}"/>
                    <input type="hidden" id="data2" value="{{Auth::user()->id}}"/>
                    <div class="card-body">
                        <canvas id="myChart" width="400" height="150"></canvas>
                        <script defer src="{{ mix('js/beerdiagramm.js') }}"></script>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Local Beer History</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-dark">
                                    <thead>
                                    <tr>
                                        <th scope="col">reporter</th>
                                        <th scope="col">date</th>
                                        <th scope="col">price</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($beers->take(5) as $item)
                                        <tr>
                                            <td>{{$item->reporter->nickname}}</td>
                                            <th scope="row">
                                                {{$item->created_at}}</th>
                                            <td>{{$item->cost}}</td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-dark">
                                    <thead>
                                    <tr>
                                        <th scope="col">reporter</th>
                                        <th scope="col">date</th>
                                        <th scope="col">price</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($beers->skip(5) as $item)
                                        <tr>
                                            <td>{{$item->reporter->nickname}}</td>
                                            <th scope="row">
                                                {{$item->created_at}}</th>
                                            <td>{{$item->cost}}</td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Local Cashflow History</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-dark">
                                    <thead>
                                    <tr>
                                        <th scope="col">reporter</th>
                                        <th scope="col">date</th>
                                        <th scope="col">price</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($cashflows->take(5) as $item)
                                        <tr>
                                            <td>{{$item->reporter->name}}</td>
                                            <th scope="row">
                                                {{$item->created_at}}</th>
                                            <td>{{$item->amount}}</td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-dark">
                                    <thead>
                                    <tr>
                                        <th scope="col">reporter</th>
                                        <th scope="col">date</th>
                                        <th scope="col">price</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($cashflows->skip(5) as $item)
                                        <tr>
                                            <td>{{$item->reporter->name}}</td>
                                            <th scope="row">{{$item->created_at}}</th>
                                            <td>{{$item->amount}}</td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
