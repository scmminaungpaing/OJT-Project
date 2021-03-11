<?php

namespace App\Contracts\Dao\Post;

interface PostDaoInterface{
    public function storePost($data);

    public function updatePost($request,$post);

    public function destroyPost($post);

    public function searchData($request);

    public function getPost();

    public function getPostUser($id);

    public function getPostUserProfile($id);
}
