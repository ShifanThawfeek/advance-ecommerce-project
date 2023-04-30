@extends('frontend.main_master')
@section('content')

<div class="body-content">
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <br>
                <img class="card-img-top" style="border-radius: 50%" src="{{ (!empty($user->profile_photo_path))? url('upload/user_images/'.$user->profile_photo_path):url('upload/no_image.jpg') }}" alt="" height="100%" width="100%">
                <br><br>
                <ul class="list-group list-group-flush">
                    <a href="{{route('dashboard')}}" class="btn btn-primary btn-sm btn-block">Home</a>
                    <a href="{{route('user.profile')}}" class="btn btn-primary btn-sm btn-block">Profile update</a>
                    <a href="" class="btn btn-primary btn-sm btn-block">Change password</a>
                    <a href="{{route('user.logout')}}" class="btn btn-danger btn-sm btn-block">Logout</a>
                </ul>

            </div>

            <div class="col-md-2">

            </div>

            <div class="col-md-6">
                <div class="card">
                    <h3 class="text-center"><span class="text-danger">Hi....</span><strong>{{Auth::User()->name}}</strong> Update Your Profile</h3>

                    <form action="{{ route('user.profile.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="info-title" for="exampleInputEmail1">Name <span></span></label>
                            <input type="text" id="name" value="{{ $user->name }}" name="name" class="form-control">
                        </div>

                        <div class="form-group">
                            <label class="info-title" for="exampleInputEmail1">Email <span></span></label>
                            <input type="text" id="email" value="{{ $user->email }}" name="email" class="form-control">
                        </div>

                        <div class="form-group">
                            <label class="info-title" for="exampleInputEmail1">Phone <span></span></label>
                            <input type="text" id="phone" value="{{ $user->phone }}" name="phone" class="form-control">
                        </div>

                        <div class="form-group">
                            <label class="info-title" for="exampleInputEmail1">User Image <span></span></label>
                            <input type="file" id="phone" value="{{ $user->phone }}" name="profile_photo_path" class="form-control">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-danger">Update</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection