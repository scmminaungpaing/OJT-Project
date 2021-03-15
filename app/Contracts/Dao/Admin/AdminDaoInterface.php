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
     * Update User 
     * @param request @request
     * @param integer $id
     */
    public function updateUser($request,$id);

    /**
     * Delete User by Admin
     * @param integer $id
     */
    public function deleUser($id);

    /**
     * Publish/Unpublish by Admin
     * @param integer $id
     */
    public function publishPost($id);

    /**
     * Remove User account by self
     * @param integer $id
     */
    public function removeAcc($id);

}
