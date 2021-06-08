<?php

namespace App\Http\Controllers;

use App\Http\Requests\Profile\ProfileUpdate;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Profiler\Profile;

class ProfileController extends Controller
{
    
    public function index(Request $request){

        $user = $request->users;
     
      

        return $this->success(new UserResource($user),'User Profile Detials');
    }

    public function update(ProfileUpdate $request,User $profile){

     
        $data = $request->except('_token','users');
        if($request->has('avatar')){
    
            $data['avatar'] = uploadImageStoragePublic($request->avatar,'users');
           
        }
       
        $profile->update($data);

    
        $users = User::find($profile->id);

        return $this->success(new UserResource(   $users),'User Profile Update Successfully');
       
    }


}
