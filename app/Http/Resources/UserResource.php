<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'user_name'=>$this->user_name,
            'email'=>$this->email,
            'avatar'=>$this->avatar,
            'user_role'=>$this->user_role,
            'registered_at'=>$this->registered_at
        ];
    }
}
