@extends('layouts.app')

@section('content')
  <div class="container mt-4">
    <div class="d-flex justify-content-between">
      <h3 class="mb-4"><i class="fas fa-edit"></i> Edit Profile</h3>
      <a href="{{ route('home') }}" class="btn btn-secondary btn-sm py-3 px-3">
        <i class="fas fa-caret-left"></i> Back</a>
    </div>
    @foreach ($data as $user)
      <form action="{{ route('update#profile', [$user->id]) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="row">
          <div class="col-sm-3">
            <img src="{{ asset('img/' . $user->profile) }}" alt="profile" width="100%">
            <div class="form-group mt-3">
              <input type="file" name="profile" class="form-control-file">
            </div>
          </div>
          <div class="col-sm-8 mb-5">
            <div class="form-group">
                <label for="name">Name :</label>
                <input type="text" name="name" value="{{ $user->name }}" class="form-control" id="name" placeholder="Enter Username">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address :</label>
                <input type="email" value="{{ $user->email }}" class="form-control" id="exampleInputEmail1" name="email" placeholder="Enter your email ">
            </div>
            <div class="form-group">
                <label for="phone">Phone No. :</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}" placeholder="Enter your phone number ">
            </div>
            <div class="form-group">
              <label for="dob">Date of Birth :</label>
              <input type="date" class="form-control" id="dob" name="dob" value="{{ $user->dob }}" placeholder="Enter your date of birth ">
            </div>
            <div class="form-group">
              <label for="address">Address :</label>
              <textarea name="address" id="address" class="form-control">{{ $user->address }}</textarea>
            </div>
              <button type="submit" class="btn btn-primary w-100">Update Profile</button>
          </div>
        </div>
      </form>
    @endforeach
  </div>
@endsection
