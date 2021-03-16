<?php

namespace App\Dao\Post;
 
use App\Contracts\Dao\Post\PostDaoInterface;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Config;

class PostDao implements PostDaoInterface{

    /** 
     * Store Post
     * @param Request $request
     * @return array
     */
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

    /** 
     * Update Post
     * @param Request $request
     * @param object $post
     * @return array
     */
    public function updatePost($request,$post){
        $publish =$request->has('publish') ? true : false;
        $post->title = $request->title;
        $post->description = $request->description;
        $post->publish = $publish;
        $post->save();
    }

    /** 
     * Delete Post
     * @param object $post
     */
    public function destroyPost($post)
    {
        $post->delete();
    }

    /** 
     * Search Post
     * @param Request $request
     * @return array
     */
    public function searchData($request)
    {
        $q = $request->search;
        return Post::where('title','LIKE','%'. $q .'%')->orWhere('description','LIKE','%'. $q .'%')->paginate(3);
    }

    /** 
     * Get all published Post
     * @param Request $request
     * @param object $post
     * @return array
     */
    public function getPost(){
        return Post::orderBy('created_at', 'DESC')->where('publish', true)->paginate(Config::get("constants.PAGINATE_NUM"));
    }

    /** 
     * Get all Post User data
     * @param integer $id
     * @return array
     */
    public function getPostUser($id)
    {
        return Post::orderBy('created_at', 'DESC')->where('user_id', $id)->get();
    }

    /** 
     *  Get Single Post User data
     * @param integer $id
     * @return array
     */
    public function getPostUserProfile($id)
    {
        return User::where('id', $id)->get();
    }
}
