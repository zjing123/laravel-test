<?php

namespace App\Http\Resources;

class AnswersResourceCollection extends ResourceCollection
{
    /**
     * Send fields to hide to UsersResource while processing the collection.
     *
     * @param $request
     * @return array
     */
    protected function processCollection($request)
    {
        return $this->collection->map(function(AnswersResource $resource) use ($request) {
            return $resource->hide($this->withoutFields)->toArray($request);
        })->all();
    }
}