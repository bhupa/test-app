<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendLink\SendLinkRequest;
use App\Http\Resources\UserPaginationResource;
use App\Mail\SendLink;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    public function index(){

        $users = $this->user->where('user_role','!=','admin')->orderBy('created_at','desc')->paginate();

        return $this->success(new UserPaginationResource($users),'User Lists');
    }

    public function sendlink(SendLinkRequest $request){
        $data = $request->except('user','_token');
        $data['verification_code']= bin2hex(random_bytes(20));
        try {
            if($output = $this->user->create($data)){
              
                Mail::to($output->email)->send(new SendLink($output));
            }
            return  $this->success($output, __('Link Successfully Send'));
        } catch (\Exception $exception) {
            return  $this->error($exception->getMessage());
        }
    }
}
