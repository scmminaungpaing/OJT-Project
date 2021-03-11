@extends('layouts.app')

@section('content')
    <div class="container mt-4 mb-5">
        @foreach ($user as $u)
            <div class="row">
                <div class="col-sm-2">
                    <img src="{{ asset('img/' . $u->profile) }}" alt="user" width="100%">
                </div>
                <div class="col-sm-10 d-flex justify-content-between">
                    <div class="px-3 pt-5">
                        <h1 class="pb-3"><i class="fas fa-user mr-1"></i> Name : {{ Str::ucfirst($u->name) }}</h1>
                        <h5><i class="fas fa-envelope mr-2"></i>E-mail : {{ Str::ucfirst($u->email) }}</h5>
                    </div>
                    <div>
                        @if (auth::check())
                            @if (auth::user()->id == $u->id)
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
                            @else
                                <a href="#" class="btn btn-outline-primary"><i class="fas fa-user-plus"></i></a>
                                <a href="#" class="btn btn-info"><i class="fas fa-heart"></i> Follow</a>
                            @endif
                        @else
                            <a href="#" class="btn btn-outline-primary"><i class="fas fa-user-plus"></i></a>
                            <a href="#" class="btn btn-info"><i class="fas fa-heart"></i> Follow</a>
                        @endif

                    </div>
                </div>
            </div>
            <div class="pt-5">
                <h5 class="pb-3"><i class="fas fa-house-user mr-1"></i>Address :
                    @if ($u->address)
                        {{ Str::ucfirst($u->address) }}
                    @else
                        Living on the moon?
                    @endif
                </h5>
                <h5 class="pb-3"><i class="fas fa-phone-square-alt mr-2"></i>Phone :
                    @if ($u->phone)
                        {{ Str::ucfirst($u->phone) }}
                    @else
                        00-0000-000-0000
                    @endif
                </h5>
                <h5 class="pb-3"><i class="fas fa-calendar-alt mr-2"></i>Date of birth :
                    @if ($u->phone)
                        {{ Str::ucfirst($u->dob) }}
                    @else
                        00 / 00 / 0000
                    @endif
                </h5>
            </div>
        @endforeach
        <hr>
        <h3>My Posts</h3>

        @foreach ($posts as $post)
            @if (Auth::check())
                @if (Auth::user()->id != $post->user_id)
                    @if ($post->publish == true)
                        <div class="card mb-4">
                            <div class="card-header d-flex justify-content-between">
                                <div><a href="{{route('post.show',[$post->id])}}">{{ Str::ucfirst($post->title) }}</a><small
                                        class="text-muted small ml-1">{{ $post->created_at->diffForHumans() }}</small>
                                </div>
                                @if (auth::check())
                                    @if (auth::user()->id == $post->user_id)
                                        <div class="d-flex">
                                            <a href="{{ route('post.edit', [$post->id]) }}" class="btn btn-info btn-sm"><i
                                                    class="fas fa-pencil-alt"></i></a>

                                            <form action="{{ route('post.destroy', [$post->id]) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-danger btn-sm ml-2"><i
                                                        class="fa fa-times"></i></button>
                                            </form>
                                        </div>
                                    @endif
                                @endif
                            </div>
                            <div class="card-body">
                                {{ $post->description }}
                            </div>
                            <div class="card-footer">
                                <span class="mr-1">Published</span>by : <a
                                    href="#">{{ Str::ucfirst($post->user->name) }}</a>
                            </div>
                        </div>
                    @endif
                @else
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between">
                            <div><a href="#">{{ Str::ucfirst($post->title) }}</a><small
                                    class="text-muted small ml-1">{{ $post->created_at->diffForHumans() }}</small></div>
                            @if (auth::check())
                                @if (auth::user()->id == $post->user_id)
                                    <div class="d-flex">
                                        @if ($post->publish == false)
                                        <a href="{{route('post.show',[$post->id])}}" class="btn btn-secondary btn-sm"><i class="fas fa-hourglass-start"></i></a>
                                        @endif
                                        <a href="{{ route('post.edit', [$post->id]) }}" class="btn btn-info btn-sm ml-2"><i
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
                            {{ $post->description }}
                        </div>
                        <div class="card-footer">
                            <span class="mr-1">Published</span>by : <a href="#">{{ Str::ucfirst($post->user->name) }}</a>
                        </div>
                    </div>
                @endif
            @else
                @if ($post->publish == true)
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between">
                            <div><a href="{{route('post.show',[$post->id])}}">{{ Str::ucfirst($post->title) }}</a><small
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
                            {{ $post->description }}
                        </div>
                        <div class="card-footer">
                            <span class="mr-1">Published</span>by : <a href="#">{{ Str::ucfirst($post->user->name) }}</a>
                        </div>
                    </div>
                @endif
            @endif
        @endforeach
    </div>
@endsection
