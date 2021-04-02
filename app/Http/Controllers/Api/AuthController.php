<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Services\Admin\AdminServiceInterface;
use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    private $authInterface;

    public function __construct(AdminServiceInterface $authInterface)
    {
        $this->authInterface = $authInterface;
    }

    public function register(Request $request){
        $this->validate($request,[
            'username'  => 'required|unique:users,name',
            'email'     => 'required|unique:users,email',
            'password'  => 'required|min:8|confirmed'
        ]);

        $user = new User();
        $user->name     = $request->username;
        $user->email    = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json(['msg'=>'Register Success'],200);
    }

    public function login(Request $request){
        $this->validate($request,[
            'email'  => 'required',
            'password'  => 'required'
        ]);

        $user = $this->authInterface->getUserByEmail($request->email);
        if (!$user || !Hash ::check($request->password, $user->password)){
            throw ValidationException::withMessages([
                'email' => ['Email or Password are incorrect.']
            ]);
        }
        return $user->createToken('ojt_project')->plainTextToken;
    }

    public function logout(Request $request){
        $request->user()->tokens()->delete();
        return response()->json(['msg' => 'Logout successful!']);
    }

    public function editUser(Request $request,$id){
        $this->validate($request,[
            'name'      => 'required | max:255',
            'email'     => 'required'
        ]);
        $user = $this->authInterface->getUser($id);
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->phone    = $request->phone;
        $user->dob      = $request->dob;
        $user->address  = $request->address;
        $user->save();
    }
}
