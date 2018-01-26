<?php

namespace App\Http\Api;

use App\Http\Api\Traits\IssueTokenTrait;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Resources\UsersResource;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\UnauthorizedException;
use App\Http\Resources\User as UserResource;

class UserController extends ApiController
{
    use IssueTokenTrait;

    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return $this->failed('用户不存在');
        }
        $user = UsersResource::make($user)->hide(['id']);

        try {
            $tokens = $this->issueToken();
        } catch (UnauthorizedException $e) {
            return $this->failed($e->getMessage());
        }

        return $this->success(['user' => $user]);
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        if (!$user) {
            return $this->failed('用户注册失败');
        }
        $user = UserResource::make($user)->hide(['id']);

        try {
            $tokens = $this->issueToken();
        } catch (UnauthorizedException $e) {
            return $this->failed($e->getMessage());
        }

        return $this->success(['tokens' => $tokens, 'user' => $user]);
    }

    public function logout()
    {

    }
}
