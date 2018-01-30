<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource as LaravelResource;

class Resource extends LaravelResource
{
    protected $withoutFields = [];

    public function hide(array $fields)
    {
        $this->withoutFields = $fields;
        return $this;
    }

    public function filterFields($array)
    {
        return collect($array)->forget($this->withoutFields)->toArray();
    }

    protected function mergeTimestamps()
    {
        return [
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

}
