@extends('layouts.welcome')

@section('content')
<div class="content flex-center text-center">
                <div class="title mb-5">
                    <a href="{{ route('login') }}">Beeerliste</a>
					
					
                </div>   
@guest	
@else
{!! Form::open(['route' => ['addbeer']]) !!}
{!! Form::submit('One Beer please!',['class' => 'btn btn-lg btn-info']) !!}
{!! Form::close() !!}
@endguest			
            </div>
@endsection
