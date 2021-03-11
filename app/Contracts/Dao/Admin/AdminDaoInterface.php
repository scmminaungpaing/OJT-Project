<?php

namespace App\Contracts\Dao\Admin;

interface AdminDaoInterface {
    public function getTotalUser();

    public function getTotalPost();

    public function getTotalRole();

    public function getUser($id);

    public function updateUser($request,$id);

    public function deleUser($id);

    public function publishPost($id);

    public function removeAcc($id);

}
