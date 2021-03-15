<?php

namespace App\Dao\Admin;

use App\Contracts\Dao\Admin\AdminDaoInterface;
use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

class AdminDao implements AdminDaoInterface {

    public function getTotalUser()
    {
        return User::paginate(10);
    }

    public function getTotalPost()
    {
        return Post::paginate(10);
    }

    public function getTotalRole()
    {
        return Role::all();
    }

    public function getUser($id)
    {
        return User::where('id',$id)->get();
    }

    public function updateUser($request, $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->dob = $request->dob;
        if($request->has('profile')){
            $imageName = time().'.'.$request->profile->extension();
            if($user->profile != Config::get('constants.PROFILE_IMG')){
                if(File::exists(public_path('img/'.$user->profile))){
                    File::delete(public_path('img/'.$user->profile));
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
        $user->save();
    }

    public function deleUser($id)
    {
        $deleimg = User::find($id);
        if($deleimg->profile != Config::get('constants.PROFILE_IMG'))
        {
            if(File::exists(public_path('img/'.$deleimg->profile))){
                File::delete(public_path('img/'.$deleimg->profile));
                $deleimg->delete();
            }
        }
        else{
            $deleimg->delete();
        }
    }

    public function publishPost($id)
    {
        $post = Post::FindOrFail($id);
        if($post->publish == true){
            $post->publish = false;
        }
        else{
            $post->publish = true;
        }
        $post->save();
    }

    public function removeAcc($id)
    {
        $user = User::FindOrFail($id);
        if($user){
            Auth::logout();
            $user->delete();
        }
    }
}
