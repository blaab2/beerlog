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
                                    <th scope="col">id</th>
                                    <th scope="col">name</th>
                                    <th scope="col">price</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($beerTypes as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>
                                            {!! Form::open(['route' => ['beertype.update', ['beertype' => $item]],'class' => ['w-100'],'method' => 'PATCH']) !!}
                                            {!! Form::text('price',$item->price) !!}
                                            {!! Form::rawSubmitBtn('Update <i class="fas fa-beer"></i>',['class' => 'btn btn-sm btn-info']) !!}
                                            {!! Form::close() !!}</td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                            <script>
                                $(document).ready(function () {
                                    $('#table-user-index').DataTable({});
                                });
                            </script>
                        </div>
                    </div>

                </div>
            </div>


        </div>
    </div>
@endsection
