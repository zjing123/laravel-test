<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection as LaravelResourceCollection;

abstract class ResourceCollection extends LaravelResourceCollection
{
    /**
     * @var array
     */
    protected $withoutFields = [];

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return $this->processCollection($request);
    }

    /**
     * @param array $fields
     * @return self
     */
    public function hide(array $fields)
    {
        $this->withoutFields = $fields;
        return $this;
    }

    /**
     * Send fields to hide to UsersResource while processing the collection.
     *
     * @param $request
     * @return array
     */
    abstract protected function processCollection($request);
}