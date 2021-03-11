<?php

namespace App\Http\Controllers;

use App\Contracts\Services\Admin\AdminServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    private $adminInterface;

    public function __construct(AdminServiceInterface $adminInterface)
    {
        $this->adminInterface = $adminInterface;
    }

    public function index(){
        $post = $this->adminInterface->getTotalPost();
        $role = $this->adminInterface->getTotalRole();
        $user = $this->adminInterface->getTotalUser();
        return view('admin.home',['users'=> $user,'posts'=> $post ,'roles' => $role]);
    }

    public function postList(){
        $post = $this->adminInterface->getTotalPost();
        return view('admin.postlist',['posts'=> $post]);
    }

    public function userList(){
        $user = $this->adminInterface->getTotalUser();
        return view('admin.userlist',['users'=> $user]);
    }

    public function roleList(){
        $role = $this->adminInterface->getTotalRole();
        return view('admin.rolelist',['roles'=> $role]);
    }

    public function editProfile($id){
        $dataList = $this->adminInterface->getUser($id);
        return view('editprofile',['data' => $dataList]);
    }

    public function updateProfile(Request $request,$id){
        $this->validate($request,[
            'name' => 'required | max:255',
            'email' => 'required',
            'profile' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120'
        ]);

        $this->adminInterface->updateUser($request,$id);

        Session::flash('message', 'Profile was Successfully Updated!');
        return redirect()->route('home');
    }

    public function deleUser($id){
        $this->adminInterface->deleUser($id);
        Session::flash('message', 'User Deleted Successfully!');
        return redirect()->route('admin#userlist');
    }

    public function publish($id){
        $this->adminInterface->publishPost($id);
        return redirect()->route('admin#postlist');
    }

    public function deleAccount($id){
        $this->adminInterface->removeAcc($id);
        Session::flash('message', 'Your Account had been Deleted!');
        return redirect()->route('frontend.home');
    }
}
