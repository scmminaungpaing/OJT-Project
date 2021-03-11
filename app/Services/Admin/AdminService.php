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

    public function getTotalUser()
    {
        return $this->adminDao->getTotalUser();
    }

    public function getTotalPost()
    {
        return $this->adminDao->getTotalPost();
    }

    public function getTotalRole()
    {
        return $this->adminDao->getTotalRole();
    }

    public function getUser($id)
    {
        return $this->adminDao->getUser($id);
    }

    public function updateUser($request, $id)
    {
        return $this->adminDao->updateUser($request,$id);
    }

    public function deleUser($id)
    {
        return $this->adminDao->deleUser($id);
    }

    public function publishPost($id)
    {
        return $this->adminDao->publishPost($id);
    }

    public function removeAcc($id)
    {
        return $this->adminDao->removeAcc($id);
    }
}
