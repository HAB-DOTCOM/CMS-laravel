@extends('layouts.app')

@section('content')

<div class="card card-defualt">
	<div class="card-header">  
		{{isset($catagory) ? 'Edit Catagory' : 'Create Catagories'}}
	</div>
	<div class="card-body">
		@include('partials.errors')
		<form action="{{isset($catagory)? route('catagories.update',$catagory->id) :route('catagories.store')}}" method="POST">
			@csrf
			@if(isset($catagory))
				@method('put')
			@endif
			<div class="form-group">
				<label for="name">Name</label>
				<input type="text" id="name" class="form-control" name="name" value="{{isset($catagory) ? $catagory->name : ' '}}">
			</div>
			<div class="form-group">
				<button class="btn btn-success">
					{{isset($catagory)? 'Update Catagory' : 'Add catagory'}}
				</button> 
					
				
			</div>
			
		</form>
	</div>
</div>
@endsection