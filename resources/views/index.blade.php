@extends('layouts.app')

@section('content')
  <div class="container mt-4">
      @if (Session::has('message'))
          <p class="alert alert-success">{{ Session::get('message') }}</p>
      @endif
      <div class="d-flex justify-content-between mb-3">
          <form action="{{ route('frontend.search') }}" method="GET" class="d-flex w-100">
              @csrf
              <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search Post Here..."
                  aria-label="Search">
              <button class="btn btn-success" type="submit"><i class="fas fa-search"></i></button>
              <div class="d-flex">
          </form>
          @if (auth::user())
              <a href="{{ route('post.create') }}" class="btn btn-info ml-2" type="submit"><i class="fas fa-plus"></i></a>
          @endif
      </div>
  </div>
  <h3>Latest Post</h3>
  @foreach ($posts as $post)
      <div class="card mb-4">
          <div class="card-header d-flex justify-content-between">
              <div><a href="{{ route('post.show', [$post->id]) }}">{{ Str::ucfirst($post->title) }}</a><small
                      class="text-muted small ml-1">{{ $post->created_at->diffForHumans() }}</small></div>
              @if (auth::check())
                  @if (auth::user()->id == $post->user_id)
                      <div class="d-flex">
                          <a href="{{ route('post.edit', [$post->id]) }}" class="btn btn-info btn-sm"><i
                                  class="fas fa-pencil-alt"></i></a>
                          <form action="{{ route('post.destroy', [$post->id]) }}" method="POST">
                              @method('DELETE')
                              @csrf
                              <button class="btn btn-danger btn-sm ml-2"><i class="fa fa-times"></i></button>
                          </form>
                      </div>
                  @endif
              @endif
          </div>
          <div class="card-body">
              {{ Str::limit($post->description, 250, '...') }}
          </div>
          <div class="card-footer">
              <span class="mr-1">Published</span>by : <a
                  href="{{ route('post#profile', [$post->user_id]) }}">{{ Str::ucfirst($post->user->name) }}</a>
          </div>
      </div>
  @endforeach
  {{ $posts->links() }}
  </div>
@endsection
