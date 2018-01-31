<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource as LaravelResource;

class Resource extends LaravelResource
{
    protected $withoutFields = [];

    protected $addFieldList = [];

    public function toArray($request)
    {
        return array_merge(
            $this->addFieldList,
            $this->mergeTimestamps()
        );
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

    public function addFields($key, $value)
    {
        $this->addFieldList[$key] = $value;
    }

    protected function mergeTimestamps()
    {
        return [
            'created_at' => (string)$this->created_at,
            'updated_at' => (string)$this->updated_at,
        ];
    }

}
