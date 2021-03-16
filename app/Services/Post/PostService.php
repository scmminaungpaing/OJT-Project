<?php

namespace App\Services\Post;

use App\Contracts\Dao\Post\PostDaoInterface;
use App\Contracts\Services\Post\PostServiceInterface;

class PostService implements PostServiceInterface{

    private $postDao;
    public function __construct(PostDaoInterface $postDao)
    {
        $this->postDao = $postDao;
    }

    /** 
     * Store Post
     * @param Request $request
     * @return array
     */
    public function storePost($request)
    {
       return $this->postDao->storePost($request);
    }

    /** 
     * Update Post
     * @param Request $request
     * @param object $post
     * @return array
     */
    public function updatePost($request,$post)
    {
       return $this->postDao->updatePost($request,$post);
    }
    
    /** 
     * Delete Post
     * @param Request $request
     * @param object $post
     */
    public function destroyPost($post)
    {
       if($post){
        return $this->postDao->destroyPost($post);
       }
    }

    /** 
     * Search Post
     * @param Request $request
     * @return array
     */
    public function searchData($request)
    {
        return $this->postDao->searchData($request);
    }

    /**
     * Get all published post
     */
    public function getPost()
    {
        return $this->postDao->getPost();
    }

    /** 
     * Get all Post User 
     * @param integer $id
     * @return array
     */
    public function getPostUser($id){
        return $this->postDao->getPostUser($id);
    }
    
    /** 
     * Get single Post User data
     * @param integer $id
     * @return array
     */
    public function getPostUserProfile($id){
        return $this->postDao->getPostUserProfile($id);
    }
}
