<?php
namespace App\Services\Admin;

use App\Contracts\Dao\Admin\AdminDaoInterface;
use App\Contracts\Services\Admin\AdminServiceInterface;

class AdminService implements AdminServiceInterface {

    private $adminDao;

    public function __construct(AdminDaoInterface $adminDao)
    {
        $this->adminDao = $adminDao;
    }

    /**
     * Get all Users
     * @return array
     */
    public function getTotalUser()
    {
        return $this->adminDao->getTotalUser();
    }

     /**
     * Get all Posts
     * @return array
     */
    public function getTotalPost()
    {
        return $this->adminDao->getTotalPost();
    }

     /**
     * Get all Roles
     * @return array
     */
    public function getTotalRole()
    {
        return $this->adminDao->getTotalRole();
    }

     /**
     * Get selected User
     * @param integer $id
     * @return array
     */
    public function getUser($id)
    {
        return $this->adminDao->getUser($id);
    }

    /**
     * Update User
     * @param Request $request
     * @param integer $id
     * @return array
     */
    public function updateUser($request, $id)
    {
        return $this->adminDao->updateUser($request,$id);
    }

     /**
     * Delete User by Admin
     * @param Request $request
     * @param integer $id
     * @return array
     */
    public function deleUser($id)
    {
        return $this->adminDao->deleUser($id);
    }

    /**
     * Publish/Unpublish by Admin
     * @param integer $id
     * @return array
     */
    public function publishPost($id)
    {
        return $this->adminDao->publishPost($id);
    }

    /**
     * Remove Account by User
     * @param integer $id
     */
    public function removeAcc($id)
    {
        return $this->adminDao->removeAcc($id);
    }
}
