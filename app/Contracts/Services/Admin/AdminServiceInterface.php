<?php

namespace App\Contracts\Services\Admin;

interface AdminServiceInterface
{
    public function getTotalUser();

    public function getTotalPost();

    public function getTotalRole();

    public function getUser($id);

    public function updateUser($request,$id);

    public function deleUser($id);

    public function publishPost($id);

    public function removeAcc($id);
}
