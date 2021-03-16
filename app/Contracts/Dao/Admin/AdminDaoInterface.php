<?php

namespace App\Contracts\Dao\Admin;

interface AdminDaoInterface {

    /**
     * Get all Users
     */
    public function getTotalUser();

    /**
     * Get all Posts
     */
    public function getTotalPost();

    /**
     * Get all Roles
     */
    public function getTotalRole();

    /**
     * Get Single User
     * @param integer $id
     */
    public function getUser($id);

    /**
     * Get Single User
     * @param integer $id
     */
    public function getUserById($id);

     /**
     * Get Single User
     * @param integer $id
     */
    public function getPostById($id);
    
    /**
     * Update User 
     * @param request @request
     * @param integer $id
     */
    public function updateUser($user);

    /**
     * Delete User by Admin
     * @param object $user
     */
    public function deleUser($user);

    /**
     * Publish/Unpublish by Admin
     * @param object $post
     */
    public function publishPost($post);

    /**
     * Remove User account by self
     * @param object $user
     */
    public function removeAcc($user);

}
