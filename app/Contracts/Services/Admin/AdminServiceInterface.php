<?php

namespace App\Contracts\Services\Admin;

interface AdminServiceInterface
{
    /**
     * Get all Users
     */
    public function getTotalUser();

    /**
     * Get User by email
     * @param string @email
     */
    public function getUserByEmail($email);

    /**
     * Get all Posts
     */
    public function getTotalPost();

    /**
     * Get all Roles
     */
    public function getTotalRole();

    /**
     * Get selected user detail
     * @param integer $id
     */
    public function getUser($id);

    /**
     * Update user detail
     * @param integer $id
     * @param Request $request
     */
    public function updateUser($request, $id);

    /**
     * Delete user by Admin
     * @param integer $id
     */
    public function deleUser($id);

    /**
     * Publish / Unpublish by admin
     * @param integer post->$id
     */
    public function publishPost($id);

     /**
     * Delete Account by user
     * @param integer post->$id
     */
    public function removeAcc($id);
}
