@extends('layouts.welcome')

@section('content')
<div class="content flex-center text-center">
                <div class="title mb-5">
                    <a href="{{ route('login') }}">Beeerliste</a>
					
					
                </div>   
@guest	
@else
{!! Form::open(['route' => ['addbeer']]) !!}
{!! Form::rawSubmitBtn('One Beer please! <i class="fas fa-beer"></i>',['class' => 'btn btn-lg btn-info']) !!}
{!! Form::close() !!}
@endguest			
            </div>
@endsection
