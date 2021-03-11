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
    <h3>Edit Post</h3>
    <a href="{{route('frontend.home')}}" class="btn btn-info btn-sm py-2 px-3"><i class="fas fa-caret-left"></i> Back</a>
  </div>
  <form action="{{route('post.update',[$post->id])}}" enctype="multipart/form-data" method="POST">
    @csrf
    @method('PATCH')
    <div class="form-group">
      <div class="row">
        <div class="col-sm-12">
          <div class="row">
            <div class="col-sm-2">
              <label for="title">Post Title :</label>
            </div>
            <div class="col-sm-8">
              <input type="text" name="title" class="form-control" id="title" value="{{$post->title}}" placeholder="Enter Post Title">
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
              <textarea name="description" id="decription" class="form-control">{{$post->description}}</textarea>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="form-group form-check">
      <input type="checkbox" name="publish" @if($post->publish == true) checked @endif class="form-check-input" id="exampleCheck1">
      <label class="form-check-label" for="exampleCheck1">Publish</label>
    </div>
    <button type="submit" class="btn btn-primary">Update Post</button>
  </form>
</div>
@endsection
