<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class ApiAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
       
        if (!empty($request->bearerToken())) {
            $key = explode(' ', getallheaders()['Authorization']);
          
            if (!empty($key[1])) {
                $user = User::where('api_token', $key[1])->first();
           
                if(!empty($user)){
                    $request->request->add(['users' => $user]);
                    return $next($request);
                } else{
                    return response()->json([
                    'status'     => false,
                    'message'    => 'Users Not Found',
                    'data'       =>  null,
                    ], 401);
                }
            }
        }

       
        return response([
            'message' => '111Unauthenticated'
        ], 403);
    }
    
}
