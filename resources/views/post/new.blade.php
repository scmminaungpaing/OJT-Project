@extends('layouts.app')

@section('tilte')
Post Create |
@endsection

@section('content')
<div class="container mt-5">
    @if ( count($errors) > 0)
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger"><i class="fas fa-exclamation-triangle"></i> {{$error}}</div>
        @endforeach
    @endif
  <div class="d-flex justify-content-between mb-4">
    <h3>Create New Post</h3>
    <a href="{{route('frontend#home')}}" class="btn btn-secondary btn-sm py-2 px-3"><i class="fas fa-caret-left"></i> Back</a>
  </div>
  <form action="{{route('post.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('POST')
    <div class="form-group">
      <div class="row">
        <div class="col-sm-12">
          <div class="row">
            <div class="col-sm-2">
              <label for="title">Post Title :</label>
            </div>
            <div class="col-sm-8">
              <input type="text" name="title" class="form-control" id="title" placeholder="Enter Post Title">
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="form-group">
      <div class="row">
        <div class="col-sm-12">
          <div class="row">
            <div class="col-sm-2">
              <label for="decription">Post Description :</label>
            </div>
            <div class="col-sm-8">
              <textarea name="description" id="decription" class="form-control" placeholder="Enter post description"></textarea>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="form-group form-check">
      <input type="checkbox" name="publish" class="form-check-input" id="exampleCheck1">
      <label class="form-check-label"for="exampleCheck1">Publish</label>
    </div>
    <input type="hidden" value="{{Auth::user()->id}}" name="user_id">
    <button type="submit" class="btn btn-primary">Upload Post</button>
  </form>
</div>
@endsection
