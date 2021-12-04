@extends('layouts.app')

@section('content')

<div class="card card-defualt">
	<div class="card-header"> 
	{{isset($post)?'Edit Post':'Create Post'}}
</div>
	<div class="card-body">
		@include('partials.errors')
		<form action="{{isset($post)? route('posts.update',$post->id):route('posts.store')}}" method="POST" enctype="multipart/form-data" >
			@csrf
			@if(isset($post))
			@method('PUT')
			@endif
			

			<div class="form-group">
				<label for="title">Title</label>
				<input type="text" name="title" class="form-control" value="{{isset($post)? $post->title : '' }}">
			</div>

			<div class="form-group">
				<label for="description">Description</label>
				<textarea name="description" id="description" cols="5" rows="5" class="form-control" >{{isset($post)? $post->description : '' }}</textarea>
			</div>
			
			<div class="form-group">
				<label for="content">Content</label>
		
				<input id="content" type="hidden" name="content" value="{{isset($post)? $post->content : '' }}">
  				<trix-editor input="content"></trix-editor>
			</div>

			<div class="form-group">
				<label for="published_at">Published At</label>
				<input type="text" name="published_at" class="form-control" id="published_at" value="{{isset($post)? $post->published_at : '' }}">
			</div>
			
			<div class="form-group">
				<label for="image"> Image</label>
				<input type="file" name="image" class="form-control">
				
			</div>

			<div class="form-group">
				<label for="catagory">Catagory</label>
				<select name="catagory" id="catagory" class="form-control">
					@foreach($catagories as $catagory)
					<option value="{{$catagory->id}}"
						@if(isset($post))
						@if($catagory->id == $post->catagory_id)
						selected
						@endif
						@endif
						>
						{{$catagory->name}}
					</option>
					@endforeach
				</select>
			</div>
			@if($tags->count()>0)
			<div class="form-group">
				<label for="tags">Tags</label>
				<select name="tags[]" id="tags" class="form-control  tags-selector" multiple="">
					@foreach($tags as $tag)
					<option value="{{$tag->id}}"
						@if(isset($post))
						@if(in_array($tag->id,$post->tags->pluck('id')->toArray()))
						selected
						@endif
						@endif
						>
						{{$tag->name}}
					</option>
					@endforeach
					
				</select>
				
			</div>
			@endif

			
			<div class="form-group">
				<button type="submit" class="btn btn-success">

				{{isset($post)?'Update Post':'Create post'}}</button>
			</div>
			
		</form>
	</div>

@endsection
@section('scripts')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.0.0/trix.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<script>
		flatpickr('#published_at',{
			enableTime:true
		})
		$(document).ready(function() {
    $('.tags-selector').select2();
});
	</script>
@endsection

@section('css')
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.0.0/trix.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection