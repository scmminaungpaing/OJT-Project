@extends('layouts.app')

@section('title')
    Post Detail |
@endsection

@section('content')
    <div class="container mt-5 px-5">
       <div class="box">
            <div class="box-header d-flex justify-content-between">
                <div>
                    <a href="{{route('post#profile',[$post->user_id])}}"><img src="{{asset("img/".$post->user->profile)}}" alt="profile" class="rounded-circle mr-2" width="50px"> {{$post->user->name}}</a><small class="text-muted ml-3"><i class="fas fa-clock"></i> {{ $post->created_at->diffForHumans() }}</small>
                </div>
                <div>
                    <a href="{{route('frontend#home')}}" class="btn btn-primary btn-sm py-2 px-3 "><i class="fas fa-backward"></i></a>
                </div>
            </div>
            <div class="box-body">
                <h3 class="mt-3">{{ Str::ucfirst($post->title) }}</h3>
                <hr>
                <div class="mb-5" style="min-height: 150px">
                    {{ $post->description }}
                </div>
                <hr>
                <div class="d-flex justify-content-between mb-2">
                    <div class="box-btn mr-3">
                        <a href="#"><i class="fas fa-thumbs-up mr-2"></i> Like</a>
                    </div>
                    <div class="box-btn mr-3">
                        <a href="#"><i class="fas fa-comment-alt mr-2"></i> Comment</a>
                    </div>
                    <div class="box-btn mr-3">
                        <a href="#"><i class="fas fa-share mr-2"></i> Share</a>
                    </div>
                </div>
            </div>
       </div>
    </div>
@endsection
