@extends('layouts.app')

@section('title')
  Admin Dashboard |
@endsection

@section('content')
  <div class="container mt-5">
    @if (Session::has('message'))
      <p class="alert alert-success">{{ Session::get('message') }}</p>
    @endif
    @if (count($errors) > 0)
      @foreach ($errors->all() as $error)
          <div class="alert alert-danger"><i class="fas fa-exclamation-triangle"></i> {{ $error }}</div>
      @endforeach
    @endif
    <div class="d-flex justify-content-between mb-3">
      <h2>PostList Dashboard</h2>
      <div>
        <a href="#" class="btn btn-primary mr-3" data-toggle="modal" data-target="#exampleModalCenter1"><i class="fas fa-upload"></i> Import Posts</a>
        <a href="#" class="btn btn-primary mr-3" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-download"></i> Download Posts</a>
        <a href="{{ route('admin.home') }}" class="btn btn-secondary"><i class="fas fa-caret-left"></i> Back</a>
      </div>
    </div>
      <strong>Total Post : {{ count($posts) }}</strong>
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">NO.</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Post User</th>
            <th scope="col">Publish</th>
            <th scope="col" colspan="2">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php $sn = 1; ?>
          @foreach ($posts as $post)
            <tr>
              <th scope="row">{{ $sn++ }}.</th>
              <td>{{ $post->title }}</td>
              <td>{{ Str::limit($post->description, 60, '...') }}</td>
              <td>{{ $post->user->name }}</td>
              @if ($post->publish == true)
                <td>
                  <form action="{{ route('publish', [$post->id]) }}" method="POST">
                    @method('PATCH')
                    @csrf
                    <button class="btn btn-info btn-sm py-0 px-2" style="font-size: 10px;font-weight:bold;">
                      <i class="fas fa-check-square"></i> Published
                    </button>
                  </form>
                </td>
              @else
                <td>
                  <form action="{{ route('publish', [$post->id]) }}" method="POST">
                    @method('PATCH')
                    @csrf
                    <button class="btn btn-secondary btn-sm py-0 px-2" style="font-size: 11px;font-weight:bold;">
                      <i class="fas fa-hourglass-half"></i> Draft</button>
                  </form>
                </td>
              @endif
              <td class="d-flex">
                  <a href="{{ route('post.show', [$post->id]) }}" class="btn btn-success btn-sm mr-2"><i class="fas fa-eye"></i></a>
                  <form action="{{ route('post.destroy', [$post->id]) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-danger btn-sm mr-2"><i class="fas fa-trash"></i></button>
                  </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      {{ $posts->links() }}
  </div>
@endsection
