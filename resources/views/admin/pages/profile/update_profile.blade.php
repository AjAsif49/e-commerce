@extends('admin.layouts.admin_master')

@section('admin')


<div class="card card-default">
    <div class="card-header card-header-border-bottom">
        <h2>User Profile</h2>       
    </div>
    @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{session('success')}}</strong> 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
    @endif
    <div class="card-body">
        <form  method="POST" action="{{ route('update.user.profile') }}" class="form-pill" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="old_image" value="{{ $user->profile_photo_path }}">


            <div class="form-group" >
                <label for="exampleFormControlPassword3">User Name</label>
                <input type="text" class="form-control" name="name" value="{{ $user['name'] }}" >               
            </div>

            <div class="form-group" >
                <label for="exampleFormControlPassword3">User Email</label>
                <input type="email" class="form-control" name="email" value="{{ $user['email'] }}" >               
            </div>

            {{-- Profile Photo --}}
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">User Image</label>
                <input type="file" name="profile_photo_path" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $user['profile_photo_path'] }}">
                
                
            
              </div>
              {{-- P.P. --}}

            <button type="submit" class="btn btn-primary btn-default" > Update Profile </button>
        </form>
    </div>
</div>








@endsection
