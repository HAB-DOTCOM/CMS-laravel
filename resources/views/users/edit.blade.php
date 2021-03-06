@extends('layouts.app')

@section('content')
            <div class="card">
                <div class="card-header">My Profile</div>

                <div class="card-body">
                    @include('partials.errors')
                    <form action="{{route('users.update')}}" method="POST" >
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{$user->name}}">
                        </div>
                        <div class="form-group">
                            <label for="about">About Me</label>
                            <textarea name="about" id="about" class="form-control" cols="5" rows="5">{{$user->about}}</textarea>
                        </div>
                        <button class="btn btn-success" type="submit">Update Profile</button>
                        
                    </form>
                </div>
                
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
