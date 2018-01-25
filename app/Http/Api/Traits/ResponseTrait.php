<?php

namespace App\Http\Api\Traits;

use Response;

trait ResponseTrait
{
    public function respond($status, $respond)
    {
        return Response::json([
            'status' => $status,
            is_string($respond) ? 'message' : 'data' => $respond
        ]);
    }

    public function success($respond = 'success!')
    {
        return $this->respond(true, $respond);
    }

    public function failed($respond = 'Request failed!')
    {
        return $this->respond(false, $respond);
    }
}