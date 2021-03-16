<?php
namespace App\Services\Admin;

use App\Contracts\Dao\Admin\AdminDaoInterface;
use App\Contracts\Services\Admin\AdminServiceInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

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
        // find user data with id
        $user = $this->adminDao->getUserById($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->dob = $request->dob;
        // check request value or not!
        if($request->has('profile')){
            $imageName = time(). '.' .$request->profile->extension();
            if($user->profile != Config::get('constants.PROFILE_IMG')){
                if(File::exists(public_path('img/' . $user->profile))){
                    File::delete(public_path('img/' . $user->profile));
                    $user->profile = $imageName;
                    $request->profile->move(public_path('img'), $imageName);
                }
                else{
                    $user->profile = $imageName;
                    $request->profile->move(public_path('img'), $imageName);
                }
            }
            else{
                $user->profile = $imageName;
                $request->profile->move(public_path('img'), $imageName);
            }
        }
        return $this->adminDao->updateUser($user);
    }

     /**
     * Delete User by Admin
     * @param Request $request
     * @param integer $id
     * @return array
     */
    public function deleUser($id)
    {
        // find user data with id
        $user = $this->adminDao->getUserById($id);
        // check user profile img is user.png or not and save that
        if($user->profile != Config::get('constants.PROFILE_IMG'))
        {
            if(File::exists(public_path('img/' . $user->profile))){
                File::delete(public_path('img/' . $user->profile));
                return $this->adminDao->deleUser($user);
            }
            else{
                return $this->adminDao->deleUser($user);
            }
        }
        else{
           return $this->adminDao->deleUser($user);
        }
    }

    /**
     * Publish/Unpublish by Admin
     * @param integer $id
     * @return array
     */
    public function publishPost($id)
    {
        // get post data with id
        $post = $this->adminDao->getPostById($id);
        // for publish feacture
        if($post->publish == true){
            $post->publish = false;
            return $this->adminDao->publishPost($post);
        }
        else{
            $post->publish = true;
            return $this->adminDao->publishPost($post);
        }
    }

    /**
     * Remove Account by User
     * @param integer $id
     */
    public function removeAcc($id)
    {
        // get user data with id
        $user = $this->adminDao->getUserById($id);
        // logout and delete account
        if($user){
            Auth::logout();
            return $this->adminDao->removeAcc($user);
        }
       
    }
}
