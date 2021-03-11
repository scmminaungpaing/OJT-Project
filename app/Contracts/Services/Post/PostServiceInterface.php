<?php

namespace App\Contracts\Services\Post;

interface PostServiceInterface{
    public function storePost($request);

    public function updatePost($request,$post);

    public function destroyPost($post);

    public function searchData($request);

    public function getPost();

    public function getPostUser($id);

    public function getPostUserProfile($id);
}
