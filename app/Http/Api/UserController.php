<?php

namespace App\Http\Api;

use App\Http\Api\Traits\IssueTokenTrait;
use App\Http\Requests\Api\RegisterRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\UnauthorizedException;

class UserController extends ApiController
{
    use IssueTokenTrait;

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return $this->failed('用户不存在');
        }

        try {
            $tokens = $this->issueToken();
        } catch (UnauthorizedException $e) {
            return $this->failed($e->getMessage());
        }

        return $this->success(['tokens' => $tokens, 'user' => $user]);
    }

    public function register(RegisterRequest $request)
    {
        return $request->all();

        $user = User::create([
            'name' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        if (!$user) {
            return $this->failed('用户注册失败');
        }

        try {
            $tokens = $this->issueToken();
        } catch (UnauthorizedException $e) {
            return $this->failed($e->getMessage());
        }

        return $this->success(['tokens' => $tokens, 'user' => $user]);

    }

    public function loginout()
    {
        if (Auth::guard('api')->check()) {
            Auth::guard('api')->user()->token()->delete();
        }

        return response()->json(['message' => '登出成功', 'status_code' => 200, 'data' => null]);
    }
}
