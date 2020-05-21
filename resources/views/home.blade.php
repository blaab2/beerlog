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
					<div class="col-sm-6 py-1">
                    {!! Form::open(['route' => ['addbeer']]) !!}
					{!! Form::submit('One Beer please!',['class' => 'btn btn-lg btn-info w-100']) !!}
					{!! Form::close() !!}
					</div>
					<div class="col-sm-6 py-1">
					{!! Form::open(['route' => ['addbeer']]) !!}
					{!! Form::hidden('count', 2) !!}
					{!! Form::submit('Two Beer please!',['class' => 'btn btn-lg btn-info w-100']) !!}
					{!! Form::close() !!}
					</div>
					</div>
                </div>
            </div>
	     </div>
		  <div class="col-md-12">
			 <div class="card">
                <div class="card-header">Beer Stats</div>
				<input type="hidden" id="data" value="{{$items->toJson()}}" />       
                <div class="card-body">
                    <canvas id="myChart" width="400" height="150"></canvas>
					 <script defer src="{{ asset('js/beerdiagramm.js') }}" defer></script>
                </div>
            </div>
			
        </div>
    </div>
</div>
@endsection
