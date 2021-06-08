<?php

namespace App\Http\Controllers;

use App\Http\Requests\Verify\VerifyRequest;
use App\Http\Requests\VerifyCode\VerifyCodeRequest;
use App\Mail\SendTokenMail;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class VerificationController extends Controller
{
    public function __construct(UserRepository $user)
    {
        
        $this->user = $user;
    }

    public function verify(VerifyRequest $request){
        $data = $request->except('_token','username');
        $data['pin'] =mt_rand(100000,999999);
        $data['user_name'] = $request->username;
        $data['password'] = bcrypt($request->password);
        $user = $this->user->where('verification_code',$request->verification_code)->first();
        try {
            if(empty($user)){
                throw new Exception(__('Invalid token'));
            }
            if($user->update($data)){
                $result = $this->user->find( $user->id);
                Mail::to($result->email)->send(new SendTokenMail($result));
            }
            return  $this->success($result, __('Please check your email token has been send'));
        } catch (\Exception $exception) {
            return  $this->error($exception->getMessage());
        }
    }
    public function verifyCode(VerifyCodeRequest $request){

        $data = $request->except('_token');
        $user = $this->user->where('pin',$request->pin)->first();
        try {
            if(empty($user)){
                throw new Exception(__('Token has been experied'));
            }
            $data['registered_at'] = Carbon::now();
            $data['pin'] = null;
            $data['verification_code'] = null;
           $user->update($data);
            return  $this->success($user, __('Your account has been verified pls login'));
        } catch (\Exception $exception) {
            return  $this->error($exception->getMessage());
        }

    }
}
