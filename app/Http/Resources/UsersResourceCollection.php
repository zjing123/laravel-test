<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UsersResourceCollection extends ResourceCollection
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
    protected function processCollection($request)
    {
        return $this->collection->map(function(UsersResource $resource) use ($request) {
            return $resource->hide($this->withoutFields)->toArray();
        })->all();
    }
}