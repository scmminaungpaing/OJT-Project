@extends('layouts.app')

@section('content')
<div class="container mt-4 mb-5">
  @if ( count($errors) > 0)
    @foreach ($errors->all() as $error)
      <div class="alert alert-danger"><i class="fas fa-exclamation-triangle"></i> {{$error}}</div>
    @endforeach
  @endif
  @if(Session::has('message'))
      <p class="alert alert-success">{{ Session::get('message') }}</p>
  @endif
  <div class="row">
      <div class="col-sm-2">
          <img src="{{ asset('img/'.Auth::user()->profile) }}" alt="user" width="100%">
      </div>
      <div class="col-sm-10 d-flex justify-content-between">
          <div class="px-3 pt-5">
              <h1 class="pb-3"><i class="fas fa-user mr-1"></i> Name : {{ Str::ucfirst(Auth::user()->name)}}</h1>
              <h5><i class="fas fa-envelope mr-2"></i>E-mail : {{ Str::ucfirst(Auth::user()->email)}}</h5>
          </div>
          <div>
              @if (Auth::user()->role->name != "admin")
              <form action="{{route('deleAccount',[Auth::user()->id])}}" method="POST" class="mr-3" style="float: left;">
                  @method('DELETE')
                  @csrf
                  <button class="btn btn-danger"><i class="fas fa-ban"></i> Delete Acc!</button>
              </form>
              @endif
              <a href="{{route('edit#profile',[Auth::user()->id])}}" class="btn btn-primary"><i class="fas fa-pencil-alt"></i> Edit Profile</a>
          </div>
      </div>
  </div>
  <div class="pt-5">
      <h5 class="pb-3"><i class="fas fa-house-user mr-1"></i>Address :
          @if (Auth::user()->address)
              {{ Str::ucfirst(Auth::user()->address)}}
          @else
              Living on the moon?
          @endif
      </h5>
      <h5 class="pb-3"><i class="fas fa-phone-square-alt mr-2"></i>Phone :
          @if (Auth::user()->phone)
              {{ Str::ucfirst(Auth::user()->phone)}}
          @else
              00-0000-000-0000
          @endif
      </h5>
      <h5 class="pb-3"><i class="fas fa-calendar-alt mr-2"></i>Date of birth :
          @if (Auth::user()->phone)
              {{ Str::ucfirst(Auth::user()->dob)}}
          @else
              00 / 00 / 0000
          @endif
      </h5>
  </div>
  <hr>
  <h3>My Posts</h3>

  @foreach ($posts as $post)
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between">
        <div>
          <a href="{{route('post.show',[$post->id])}}">{{ Str::ucfirst($post->title)}}</a>
          <small class="text-muted small ml-1">{{ $post->created_at->diffForHumans() }}</small>
        </div>
        @if (auth::check())
            @if (auth::user()->id == $post->user_id)
              <div class="d-flex">
                  @if ($post->publish == false)
                  <a href="#" class="btn btn-secondary btn-sm mr-2"><i class="fas fa-hourglass-start"></i></a>
                  @endif
                  <a href="{{route('post.edit',[$post->id])}}" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></a>

                  <form action="{{route('post.destroy',[$post->id])}}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-danger btn-sm ml-2"><i class="fa fa-times"></i></button>
                  </form>
              </div>
            @endif
        @endif
        </div>
        <div class="card-body">
            {{$post->description}}
        </div>
        <div class="card-footer">
        <span class="mr-1">Published</span>by : <a href="#">{{ Str::ucfirst($post->user->name)}}</a>
        </div>
    </div>
  @endforeach
</div>
@endsection

