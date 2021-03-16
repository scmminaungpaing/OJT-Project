<?php

namespace App\Dao\Admin;

use App\Contracts\Dao\Admin\AdminDaoInterface;
use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

class AdminDao implements AdminDaoInterface {

    /**
     * Get all Users
     * @return array
     */
    public function getTotalUser()
    {
        return User::paginate(Config::get("constants.PAGINATE_NUM"));
    }

    /**
     * Get all Posts
     * @return array
     */
    public function getTotalPost()
    {
        return Post::paginate(Config::get("constants.PAGINATE_NUM"));
    }

    /**
     * Get all Roles
     * @return array
     */
    public function getTotalRole()
    {
        return Role::all();
    }

    /**
     * Get Single User 
     * @param integer $id
     * @return array
     */
    public function getUser($id)
    {
        return User::where('id', $id)->get();
    }

    /**
     * Get Single User by ID
     * @param integer $id
     * @return array
     */
    public function getUserById($id){
        return User::find($id);
    }

    /**
     * Get Single Post by ID
     * @param integer $id
     * @return array
     */
    public function getPostById($id){
        return Post::find($id);
    }

    /**
     * Update user data
     * @param integer $id
     * @param Request $request
     */
    public function updateUser($user)
    {
        $user->save();
    }

    /**
     * Delete User By Admin
     * @param object $user
     */
    public function deleUser($user)
    {
        $user->delete();
    }

    /**
     * Publish/UnPublish post by Admin
     * @param object $post
     */
    public function publishPost($post)
    {
        $post->save();
    }

    /**
     * Removed Account by user
     * @param integer $id
     */
    public function removeAcc($user)
    {
        $user->delete();
    }
}
