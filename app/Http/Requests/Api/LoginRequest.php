<?php

namespace App\Http\Requests\Api;

class LoginRequest extends FormRequest
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
            'email' => 'required|email|max:255',
            'password' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'email.required'     => '请输入email',
            'email.email'        => '请输入有效email',
            'email.max'          => 'email不能超过64个字符',
            'password.required'  => '请输入密码',
        ];
    }
}