<?php

namespace App\Http\Requests\Api;

class RegisterRequest extends FormRequest
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
            'name'     => 'required|max:16|unique:users',
            'email'    => 'required|email|max:64|unique:users',
            'password' => 'required|min:6|max:16|confirmed'
        ];
    }

    public function messages()
    {
        return [
            'name.required'      => '请输入用户名',
            'name.max'           => '用户名不能超过16个字',
            'name.unique'        => '用户名已经存在了',
            'email.required'     => '请输入email',
            'email.email'        => '请输入有效email',
            'email.max'          => 'email不能超过64个字符',
            'email.unique'       => 'email已经存在',
            'password.required'  => '请输入密码',
            'password.min'       => '密码不能小于6个字符',
            'password.max'       => '密码不能超过16个字符',
            'password.confirmed' => '两次密码输入不一致'
        ];
    }

//    public function response(array $errors)
//    {
//        $transformed = [];
//
//        foreach ($errors as $field => $message) {
//            $transformed[] = [
//                'field' => $field,
//                'message' => $message[0]
//            ];
//        }
//
//        return Response::json([
//            'status' => false,
//            'errors' => $transformed
//        ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
//    }
}
