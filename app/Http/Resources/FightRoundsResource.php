<?php

namespace App\Http\Resources;

use App\Http\Resources\Resource;

class FightRoundsResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->filterFields(
            array_merge([
                'id' => $this->id,
                'fight_id' => $this->fight_id,
                'question_id' => $this->question_id,
                'completed' => $this->completed,
                'records' => FightRoundRecordsResource::collection($this->whenLoaded('records')) ,
            ], parent::toArray($request))
        );
    }

    public static function collection($resource)
    {
        return tap(new FightRoundsResourceCollection($resource), function($collection) {
            $collection->collects = __CLASS__;
        });
    }
}
