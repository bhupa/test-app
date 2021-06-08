<?php

namespace App\Http\Controllers;

use App\Http\Requests\Login\LoginRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function __construct(UserRepository $user)
    {
        $this->user =$user;
    }
    public function login(LoginRequest $request){
        
        $credentials = [
            'email' =>$request->email,
            'password' => $request->password
        ];

       ;
        if (Auth::attempt($credentials)) {
            
            auth()->user()->update(['api_token'=>bin2hex(random_bytes(20))]);
             return $this->success(auth()->user(),'User Login Successfully');
        }

        return  $this->error('Email or password donot match ');
    }
    public function logout(Request $request){
       
        try {
            $userId = $request->users;
         
            $user= $this->user->find($userId->id);
           
            if($user) {
                $data=$this->user->where('id', $userId->id)->update(['api_token' => null]);
                Auth::logout();
                return $this->success('Logout Successfully');
            }
            else{
                return  $this->error('User not found');
            }
        } catch (Exception $e) {
            return response()->json(['message' => 'Something went wrong!!'], 500);
        }

    }
}
