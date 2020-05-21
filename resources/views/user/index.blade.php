@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">User List</div>
            
            </div>
	     </div>
		
		<div  class="col-md-12">
			<table class="table table-dark">
			  <thead>
				<tr>
				  <th scope="col">#</th>
				  <th scope="col">Name</th>
				  <th scope="col">Nickname</th>
				  <th scope="col">Email</th>
				  <th scope="col">Beer</th>
				  <th scope="col">Depts</th>
				</tr>
			  </thead>
			  <tbody>
			  @foreach ($items as $item)
				<tr>
				  <th scope="row">1</th>
				  <td>{{$item->name}}</td>
				  <td>{{$item->nickname}}</td>
				  <td>{{$item->email}}</td>
				  <td>{{$item->beers_count}}</td>
				  <td>{{$item->beers_count}}</td>
				</tr>
			@endforeach
				
			  </tbody>
			</table>
		</div>
		
    </div>
</div>
@endsection
