<?php

namespace App\Http\Requests\Profile;

use App\Http\Requests\CustomRequest;
use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdate extends CustomRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_name'=>'required',
            'avatar'=>'nullable|',
            'email'=>"nullable|email|unique:users,email,".$this->id
        ];
    }
}
