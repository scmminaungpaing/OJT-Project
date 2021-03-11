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

    public function storePost($request)
    {
       return $this->postDao->storePost($request);
    }

    public function updatePost($request,$post)
    {
       return $this->postDao->updatePost($request,$post);
    }

    public function destroyPost($post)
    {
       if($post){
        return $this->postDao->destroyPost($post);
       }
    }

    public function searchData($request)
    {
        return $this->postDao->searchData($request);
    }

    public function getPost()
    {
        return $this->postDao->getPost();
    }

    public function getPostUser($id){
        return $this->postDao->getPostUser($id);
    }

    public function getPostUserProfile($id){
        return $this->postDao->getPostUserProfile($id);
    }
}
