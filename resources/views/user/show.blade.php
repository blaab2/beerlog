@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Overview User {{$user->nickname}}</div>

                    <div class="card-body">

                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Recent Drinks Ranking</div>
                    <input type="hidden" id="data1" value="{{$users->toJson()}}"/>
                    <input type="hidden" id="data2" value="{{Auth::user()->id}}"/>
                    <input type="hidden" id="data3" value="{{$user->id}}"/>
                    <div class="card-body">
                        <canvas id="myChart" width="400" height="150"></canvas>
                        <script defer src="{{ mix('js/beerdiagramm.js') }}"></script>
                    </div>
                </div>
            </div>
            @can('show details')
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Local Drinks History</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-dark">
                                        <thead>
                                        <tr>
                                            <th scope="col">date</th>
                                            <th scope="col">type</th>
                                            <th scope="col">price</th>
                                            @can('show details')
                                                <th scope="col">reporter</th>
                                                <th scope="col">opt.</th>@endcan
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($beers->take(5) as $item)
                                            <tr>
                                                <th scope="row">{{$item->created_at}}</th>
                                                <td>{{$item->beerType->name}}</td>
                                                <td>{{$item->cost}}</td>


                                                @can('show details')
                                                    <td>{{$item->reporter->nickname}}</td>
                                                    <td><a class="btn btn-sm btn-info"
                                                           onclick="swalbeerdeletedialog('{{route('beers.destroy',['beer'=>$item])}}'); return false;"
                                                           href="#"><i class="fas fa-trash"></i></a>
                                                    </td>@endcan
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            <div class="col-md-6">
                                <table class="table table-dark">
                                    <thead>
                                    <tr>
                                        <th scope="col">date</th>
                                        <th scope="col">price</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($beers->skip(5) as $item)
                                        <tr>
                                            <th scope="row">{{$item->created_at}}</th>
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
            @endcan
        </div>
    </div>
@endsection
