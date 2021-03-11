<?php

namespace App\Dao\Post;

use App\Contracts\Dao\Post\PostDaoInterface;
use App\Models\Post;
use App\Models\User;

class PostDao implements PostDaoInterface{
    public function storePost($data)
    {
        $publish =$data->has('publish') ? true : false;
        $post = new Post();
        $post->title = $data->title;
        $post->description = $data->description;
        $post->user_id = $data->user_id;
        $post->publish = $publish;
        $post->save();
    }

    public function updatePost($request,$post){
        $publish =$request->has('publish') ? true : false;
        $post->title = $request->title;
        $post->description = $request->description;
        $post->publish = $publish;
        $post->save();
    }

    public function destroyPost($post)
    {
        $post->delete();
    }

    public function searchData($request)
    {
        $q = $request->search;
        return Post::where('title','LIKE','%'.$q.'%')->orWhere('description','LIKE','%'.$q.'%')->paginate(3);
    }

    public function getPost(){
        return Post::orderBy('created_at','DESC')->where('publish',true)->paginate(5);
    }

    public function getPostUser($id)
    {
        return Post::orderBy('created_at','DESC')->where('user_id',$id)->get();
    }

    public function getPostUserProfile($id)
    {
        return User::where('id',$id)->get();
    }
}
