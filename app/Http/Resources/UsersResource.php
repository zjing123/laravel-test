<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class UsersResource extends Resource
{
    /**
     * @var array
     */
    protected $withoutFields = [];

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->filterFields($this->resource->toArray());
    }

    public function hide(array $fields)
    {
        $this->withoutFields = $fields;
        return $this;
    }

    public static function collection($resource)
    {
        return tap(new UsersResourceCollection($resource), function($collection) {
            $collection->collects = __CLASS__;
        });
    }

    protected function filterFields($array)
    {
        return collect($array)->forget($this->withoutFields)->toArray();
    }
}
