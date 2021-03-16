<?php

namespace App\Contracts\Services\Post;

interface PostServiceInterface{

    /**
     * Store Post 
     * @param Request $request
     */
    public function storePost($request);

    /**
     * Update Post 
     * @param Request $request
     * @param object $post
     */
    public function updatePost($request,$post);

    /**
     * Delete Post
     * @param object $post
     */
    public function destroyPost($post);

    /**
     * Search Post 
     * @param Request $request
     */
    public function searchData($request);

    /**
     * Get all Posts
     */
    public function getPost();

    /**
     * Get Post User
     * @param integer $id
     */
    public function getPostUser($id);
    
    /**
     * Get Post UserProfile
     * @param integer $id
     */
    public function getPostUserProfile($id);
}
