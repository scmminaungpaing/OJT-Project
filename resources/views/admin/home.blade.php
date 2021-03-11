@extends('layouts.app')

@section('content')
  <div class="container mt-5">
    <div class="d-flex justify-content-between">
      <h3><i class="fas fa-columns"></i> Dashboard</h3>
      <a href="{{ route('post#profile', [Auth::user()->id]) }}" class="btn btn-info"><i class="fas fa-cog"></i> Setting</a>
    </div>
    <div class="row mt-5">
      <div class="col-sm-12">
        <div class="d-flex justify-content-between">
          <div class="col-sm-3 bg-warning mr-2 text-center text-white big pt-5 pb-3">{{ count($users) }}
            <div class="admin-card"><a href="{{ route('admin#userlist') }}"><i class="fas fa-user"></i> Users</a></div>
          </div>
          <div class="col-sm-3 bg-success mr-2 text-center text-white big pt-5 pb-3">{{ count($posts) }}
            <div class="admin-card"><a href="{{ route('admin#postlist') }}"><i class="fas fa-clipboard"></i> Posts</a></div>
          </div>
          <div class="col-sm-3 bg-danger text-center text-white big pt-5 pb-3"> {{ count($roles) }}
            <div class="admin-card"><a href="{{ route('admin#rolelist') }}"><i class="fas fa-users"></i> Roles</a></div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
