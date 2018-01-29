<?php

namespace App\Http\Resources;

class UsersResource extends Resource
{
    protected $withoutFields = [];

    public function toArray($request)
    {
        return $this->filterFields([
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email
        ]);
    }

    public function hide(array $fields)
    {
        $this->withoutFields = $fields;
        return $this;
    }

    public function filterFields($array)
    {
        return collect($array)->forget($this->withoutFields)->toArray();
    }

    public static function collection($resource)
    {
        return tap(new UsersResourceCollection($resource), function($collection) {
            $collection->collects = __CLASS__;
        });
    }
}
