@extends('layouts.app')

@section('title')
    Admin Dashboard |
@endsection

@section('content')
  <div class="container mt-5">
    <div class="d-flex justify-content-between mb-3">
        <h2>PostList Dashboard</h2>
        <div>
            <a href="{{route('admin#home')}}" class="btn btn-secondary"><i class="fas fa-caret-left"></i>  Back</a>
        </div>
    </div>
      <strong>Total Role : {{count($roles)}}</strong>
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">NO.</th>
          <th scope="col">Name</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
          <?php $sn=1;?>
        @foreach ($roles as $role)
        <tr>
          <th scope="row">{{$sn++}}.</th>
          <td>{{ $role->name }}</td>
          <td>
            <a href="#" class="btn btn-info btn-sm mr-2"><i class="fas fa-pencil-alt"></i></a>
            <a href="#" class="btn btn-danger btn-sm mr-2"><i class="fas fa-trash"></i></a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
