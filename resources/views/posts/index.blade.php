@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-end mb-2">
	<a href="{{ route('posts.create')}}" class="btn btn-success float-right ">Add post</a>
</div>
<div class="card card-defualt">
	<div class="card-header"> posts</div>

	<div class="card-body">
		@if($posts->count()>0)
		<table class="table">
			<thead>
				<th>Image</th>
				<th>Title</th>
				<th>
					Catagory
				</th>
				<th>
					
				</th>
			</thead>
			<tbody>
				@foreach($posts as $post)
				<tr>
					<td>
						
						<img src="{{ asset('storage/' . $post->image) }}" width="120px" height="60px" alt="Image" />
					</td>
					<td>
						{{$post->title}}

					</td>
					<td>
					<a href="{{route('catagories.edit',$post->catagory->id)}}">
						{{$post->catagory->name}}
					</a>
					</td>
					
						@if(!$post->trashed())
						<td>
							<a href="{{route('posts.edit',$post->id)}}" class="btn btn-info btn-sm">Edit</a>
						</td>
						@else
						<td>
							<form action="{{ route('posts.restore',$post->id)}}" method="POST">
								@csrf
								@method('PUT')
								<button type="submit" class="btn btn-success">Restore</button>
							</form>
							
						</td>

						@endif

					

					<td>
						<form action="{{route('posts.destroy' , $post->id)}}" method="POST">
							@csrf
							@method('DELETE')
							<button type="submit" class="btn btn-danger btn-sm">
								{{$post->trashed() ? 'Delete' :'Trash'}}
							</button>
						</form>
					</td>
					
				</tr>
				@endforeach
			</tbody>
		</table>
		@else
		<h3 class="text-center">No Post Yet!</h3>
		@endif
		
	</div>
@endsection