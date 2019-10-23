<?php

namespace App\Http\Requests\Setting;

use App\Http\Requests\FormRequest;

class UserRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:sys_users,email,'.request()->id],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'role' => ['required'],
        ];

        if(request()->has('id') && request()->password == ''){
            unset($rules['password']);
        }

        return $rules;
    }
}
