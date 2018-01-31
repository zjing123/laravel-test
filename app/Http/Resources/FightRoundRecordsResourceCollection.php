<?php

namespace App\Http\Resources;

use App\Http\Resources\ResourceCollection;

class FightRoundRecordsResourceCollection extends ResourceCollection
{
    protected function processCollection($request)
    {
        return $this->collection->map(function(FightRoundRecordsResource $resource) use ($request) {
            return $resource->hide($this->withoutFields)->toArray($request);
        })->all();
    }
}
