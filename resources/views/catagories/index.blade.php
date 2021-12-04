@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-end mb-2">
	<a href="{{ route('catagories.create')}}" class="btn btn-success float-right ">Add Catagory</a>
</div>
<div class="card card-defualt">
	<div class="card-header"> Catagories</div>
	<div class="card-body">
		@if($catagories->count()>0)
		<table class="table">
			<thead>
				<th>Name</th>
				<th>
					Post Count
				</th>
				<th>
					
				</th>
			</thead>
			<tbody>
				@foreach($catagories as $catagory)
				<tr>
					<td>
						{{$catagory->name}}
					</td>
					<td>
						{{$catagory->posts->count()}}
					</td>
					<td>
						<a href="{{ route('catagories.edit',$catagory->id)}}" class="btn btn-info btn-sm">
							Edit
						</a>
						<button class="btn btn-danger btn-sm" onclick="handleDelete({{$catagory->id}})">Delete</button>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		@else
		<h3 class="text-center">No Catagory Yet!</h3>
		@endif

		<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="" method="POST" id="deletecatagoryform">
    	@csrf
    	@method('DELETE')
    	
    	<div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Delete Modal</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       <p class="text-center text-bold">
       	Are you shure to delete this catagory?
       </p>
      </div>
    </form>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No Go Back</button>
        <button type="submit" class="btn btn-danger">Yes,Delete</button>
      </div>
    </div>
  </div> 
</div>
	</div>
</div>
@endsection

@section('scripts')
	<script>
		function handleDelete(id){

			var form=document.getElementById('deletecatagoryform')
			form.action= '/catagories/' + id
			$('#deleteModal').modal('show')
		}
	</script>

@endsection