@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">User List</div>
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
                        <div class="table-responsive-md">
                            <table class="table table-dark" id="table-user-index">
                                <thead>
                                <tr>
                                    <th scope="col">Add Beer</th>
                                    <th scope="col">Nickname</th>
                                    @can('show details')
                                        <th scope="col">Name</th>@endcan
                                    @can('show details')
                                        <th scope="col">Email</th>@endcan

                                    <th scope="col">Recent <i class="fas fa-beer"></i></th>
                                    <th scope="col">Total <i class="fas fa-beer"></i></th>
                                    <th scope="col">Credit (€)</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($items as $item)
                                    <tr>
                                        <td>
                                            <a class="btn btn-sm btn-info"
                                               onclick="swalbeerdialog('{{route('users.beers.store',['user'=>$item])}}',1); return false;"
                                               href="#">+<i class="fas fa-beer"></i></a>
                                        </td>
                                        <th scope="row"><a
                                                href="{{ route('users.show', ['user' => $item]) }}">{{$item->nickname}}</a>
                                        </th>
                                        @can('show details')
                                            <td>{{$item->name}}</td>@endcan
                                        @can('show details')
                                            <td>{{$item->email}}</td>@endcan
                                        <td>{{$item->beers_count}}</td>
                                        <td>{{$item->total_beers_count}}</td>
                                        <td @if(number_format($item->cashflow-$item->depts<0))class="text-warning"@endif>{{ number_format($item->cashflow-$item->depts, 2, '.', '.')}}</td>
                                        <td>
                                            <a class="btn btn-sm btn-primary" role="button"
                                               href="{{ route('users.show', ['user' => $item]) }}"
                                               title="Go to view this user"><i class="fas fa-user"></i></a>
                                            @can('show finances')
                                                <a class="btn btn-sm btn-primary" role="button"
                                                   onclick="submitrecieptdialog('{{ route('users.cashflow.store', ['user' => $item]) }}'); return false;"
                                                   href="#" title="change admin status of this user"><i
                                                        class="fas fa-money-bill-alt"></i></a>
                                            @endcan
                                            @can('make admin')
                                                @if($item->admin)
                                                    <a class="btn btn-sm btn-primary" role="button"
                                                       onclick="swaladminswapdialog('{{ route('users.swapadmin', ['user' => $item]) }}',this); return false;"
                                                       href="#" title="change admin status of this user"><i
                                                            class="fas fa-crown"></i></a>
                                                @else
                                                    <a class="btn btn-sm btn-secondary" role="button"
                                                       onclick="swaladminswapdialog('{{ route('users.swapadmin', ['user' => $item]) }}',this); return false;"
                                                       href="#" title="change admin status of this user"><i
                                                            class="fas fa-crown"></i></a>
                                                @endif
                                            @endcan
                                        </td>

                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                            <script>
                                $(document).ready(function () {
                                    $('#table-user-index').DataTable({
                                        "columnDefs": [
                                            {
                                                "targets": [2],
                                                "visible": true
                                            },
                                            {
                                                "targets": [3],
                                                "visible": false
                                            }
                                        ]
                                    });
                                });
                            </script>
                        </div>
                    </div>

                </div>
            </div>


        </div>
    </div>
@endsection
