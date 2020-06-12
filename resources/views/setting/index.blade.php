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
                                    <th scope="col">setting</th>
                                    <th scope="col">value</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($settings as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td>{{$item->key}}</td>
                                        <td>
                                            {!! Form::open(['route' => ['settings.update', ['setting' => $item]],'class' => ['w-100'],'method' => 'PATCH']) !!}
                                            {!! Form::text('value',$item->value) !!}
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
