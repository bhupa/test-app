<?php

namespace App\Http\Requests\Verify;

use App\Http\Requests\CustomRequest;
use Illuminate\Foundation\Http\FormRequest;

class VerifyRequest extends CustomRequest
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
            'username'=>'required',
            'password'=>'required',
            'verification_code'=>'required|exists:users,verification_code'
        ];
    }
}
