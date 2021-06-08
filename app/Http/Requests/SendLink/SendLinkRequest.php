<?php

namespace App\Http\Requests\SendLink;

use App\Http\Requests\CustomRequest;
use Illuminate\Foundation\Http\FormRequest;

class SendLinkRequest extends CustomRequest
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
            'email'=>'required|email|unique:users,email',
            'user_role'=>'required|in:admin,user'
        ];
    }
}
