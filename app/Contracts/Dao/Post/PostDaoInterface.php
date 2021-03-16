<?php

namespace App\Contracts\Dao\Post;

interface PostDaoInterface{
    /**
     * Store Post 
     * @param Request $data
     */
    public function storePost($data);

    /** 
     * Update Post 
     * @param Request $request
     * @param object $post
     */
    public function updatePost($request,$post);
    
    /** 
     * Delete Post 
     */
    public function destroyPost($post);
    
    /** 
     * Search Post 
     */
    public function searchData($request);

    /** 
     * Get all Post 
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
