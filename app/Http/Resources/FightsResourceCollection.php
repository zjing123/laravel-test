<?php

namespace App\Http\Resources;

use App\Http\Resources\ResourceCollection;

class FightsResourceCollection extends ResourceCollection
{
    public function processCollection($request)
    {
        return $this->collection->map(function(FightsResource $resource) use ($request) {
            return $resource->hide($this->withoutFields)->toArray($request);
        })->all();
    }
}
