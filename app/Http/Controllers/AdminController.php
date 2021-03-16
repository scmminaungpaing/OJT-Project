<?php

namespace App\Http\Controllers;

use App\Contracts\Services\Admin\AdminServiceInterface;
use App\Http\Requests\UserProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    private $adminInterface;

    public function __construct(AdminServiceInterface $adminInterface)
    {
        $this->adminInterface = $adminInterface;
    }

    /**
    * Get all Data list for Dashboard
    * @return     Response
    */
    public function index(){
        $post = $this->adminInterface->getTotalPost();
        $role = $this->adminInterface->getTotalRole();
        $user = $this->adminInterface->getTotalUser();
        return view('admin.home', ['users'=> $user, 'posts'=> $post , 'roles' => $role]);
    }

    /**
    * Get all Posts list for Dashboard
    * @return     Response
    */
    public function postList(){
        $post = $this->adminInterface->getTotalPost();
        return view('admin.postlist', ['posts'=> $post]);
    }

    /**
    * Get all Users list for Dashboard
    * @return     Response
    */
    public function userList(){
        $user = $this->adminInterface->getTotalUser();
        return view('admin.userlist', ['users'=> $user]);
    }

    /**
    * Get all Roles list for Dashboard
    * @return     Response
    */
    public function roleList(){
        $role = $this->adminInterface->getTotalRole();
        return view('admin.rolelist', ['roles'=> $role]);
    }

    /**
    * Edit User profile 
    * @param    Integer     $id
    * @return     Response
    */
    public function editProfile($id){
        $dataList = $this->adminInterface->getUser($id);
        return view('editprofile', ['data' => $dataList]);
    }

    /**
    * Update User profile 
    * @param    Request     $request
    * @param    Integer     $id
    * @return     Response
    */
    public function updateProfile(UserProfileRequest $request, $id){
        $this->adminInterface->updateUser($request,$id);
        Session::flash('message', 'Profile was Successfully Updated!');
        return redirect()->route('home');
    }

    /**
    * Delete User profile 
    * @param    Integer     $id
    * @return     Response
    */
    public function deleUser($id){
        $this->adminInterface->deleUser($id);
        Session::flash('message', 'User Deleted Successfully!');
        return redirect()->route('admin#userlist');
    }

    /**
    * Publich/Draft of Post
    * @param    Integer   post->$id
    * @return     Response
    */
    public function publish($id){
        $this->adminInterface->publishPost($id);
        return redirect()->route('admin#postlist');
    }

     /**
    * Remove User account by self 
    * @param    Integer   user->$id
    * @return     Response
    */
    public function deleAccount($id){
        $this->adminInterface->removeAcc($id);
        Session::flash('message', 'Your Account had been Deleted!');
        return redirect()->route('frontend#home');
    }
}
