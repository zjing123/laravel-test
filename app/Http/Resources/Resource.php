<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource as LaravelResource;

class Resource extends LaravelResource
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

    protected function filterFields($array)
    {
        return collect($array)->forget($this->withoutFields)->toArray();
    }
}
