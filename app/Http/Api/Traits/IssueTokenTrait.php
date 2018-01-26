<?php

namespace App\Http\Api\Traits;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Validation\UnauthorizedException;
use Zend\Diactoros\Request;

trait IssueTokenTrait
{

    public function issueToken()
    {
        $http = new Client();

        try {
            $url = request()->root() . '/oauth/token';

            $params = array_merge(config('passport.proxy'), [
                'username' => request('email'),
                'password' => request('password'),
            ]);

            $respond = $http->request('POST', $url, ['form_params' => $params]);
        } catch (RequestException $exception) {
            throw new UnauthorizedException('请求失败,服务器错误' . $exception->getMessage() . json_encode($params));
        }

        if ($respond->getStatusCode() !== 401) {
            return json_decode($respond->getBody()->getContents(), true);
        }

        throw new UnauthorizedException('用户账号或密码错误');
    }
}