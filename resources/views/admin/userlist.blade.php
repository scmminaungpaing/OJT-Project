@extends('layouts.app')

@section('title')
  Admin Dashboard |
@endsection

@section('content')
  <div class="container mt-5">
    @if (Session::has('message'))
        <p class="alert alert-success">{{ Session::get('message') }}</p>
    @endif
    <div class="d-flex justify-content-between mb-3">
      <h2>UserList Dashboard</h2>
      <div>
        <a href="#" class="btn btn-primary mr-3" data-toggle="modal" data-target="#exampleModalCenter2"><i class="fas fa-download"></i> Download Users</a>
        <a href="{{ route('admin.home') }}" class="btn btn-secondary"><i class="fas fa-caret-left"></i> Back</a>
      </div>
    </div>
      <strong>Total Users : {{ count($users) }}</strong>
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">NO.</th>
          <th scope="col">Name</th>
          <th scope="col" class="text-center">E-mail</th>
          <th scope="col" class="text-center">Phone</th>
          <th scope="col">Profile</th>
          <th scope="col">Role</th>
          <th scope="col" class="text-center">Address</th>
          <th scope="col" class="text-center">DOB</th>
          <th scope="col" colspan="2">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php $sn = 1; ?>
        @foreach ($users as $user)
          <tr>
            <th scope="row">{{ $sn++ }}.</th>
            <td>{{ $user->name }}</td>
            <td class="text-center">{{ $user->email }}</td>
            <td class="text-center">
              @if ($user->phone)
                  {{ $user->phone }}
              @else
                  -
              @endif
            </td>
            <td><img src="{{ asset('img/' . $user->profile) }}" alt="profile" width="50px"></td>
            <td>{{ $user->role->name }}</td>
            <td class="text-center">
                @if ($user->address)
                    {{ Str::limit($user->address, 10, '...') }}
                @else
                    -
                @endif
            </td>
            <td class="text-center">
                @if ($user->dob)
                    {{ $user->dob }}
                @else
                    -
                @endif
            </td>
              <td class="d-flex">
                <a href="{{ route('post#profile', [$user->id]) }}" class="btn btn-success btn-sm mr-2">
                  <i class="fas fa-eye"></i></a>
                  {{-- <a href="#" class="btn btn-danger btn-sm mr-2"><i class="fas fa-trash"></i></a> --}}
                  @if ($user->role->name == 'admin')
                    <a href="{{ route('edit#profile', [$user->id]) }}" class="btn btn-info btn-sm mr-2">
                      <i class="fas fa-pencil-alt"></i></a>
                  @else
                    <form action="{{ route('deleteUser', [$user->id]) }}" method="POST">
                      @method('DELETE')
                      @csrf
                      <button class="btn btn-danger btn-sm mr-2"><i class="fas fa-trash"></i></button>
                    </form>
                  @endif
              </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    {{ $users->links() }}
  </div>
@endsection
