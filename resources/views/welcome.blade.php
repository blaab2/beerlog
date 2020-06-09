@extends('layouts.welcome')

@section('content')
<div class="content flex-center text-center">
	<div class="row">
		<div class="col-12"> 
			<div class="title mb-3">
				<a href="{{ route('login') }}">Bierliste</a>			
			</div>   
		</div>
	</div>
	@guest	
	@else
	<div class="row">
		<div class="col-md-12 col-12"> 
			{!! Form::open(['route' => ['addbeer'],'class' => ['w-100']]) !!}
			{!! Form::rawSubmitBtn('One Beer please! <i class="fas fa-beer"></i>',['class' => 'btn btn-lg btn-info w-100']) !!}
			{!! Form::close() !!}
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 col-12"> 
			<div class="mt-2"><a class="btn btn-lg btn-primary w-100" href="{{ route('users.index') }}">Register beer for a mate <i class="fas fa-user-friends"></i></a></div>	
		</div>
	</div>
	@endguest			
</div>
@endsection
