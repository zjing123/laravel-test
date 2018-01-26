<?php

namespace App\Http\Resources;

class UsersResource extends Resource
{
    public static function collection($resource)
    {
        return tap(new UsersResourceCollection($resource), function($collection) {
            $collection->collects = __CLASS__;
        });
    }
}
