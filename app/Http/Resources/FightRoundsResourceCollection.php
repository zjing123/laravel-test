<?php

namespace App\Http\Resources;

class FightRoundsResourceCollection extends ResourceCollection
{
    protected function processCollection($request)
    {
        return $this->collection->map(function(FightRoundsResource $resource) use ($request) {
            return $resource->hide($this->withoutFields)->toArray($request);
        })->all();
    }
}
