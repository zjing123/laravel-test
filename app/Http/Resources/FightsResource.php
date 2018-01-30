<?php

namespace App\Http\Resources;

class FightsResource extends Resource
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
                'id'         => $this->id,
                'user_id'    => $this->user_id,
                'to_user_id' => $this->to_user_id,
                'resign'     => $this->resign,
                'completed'  => $this->completed,
                'rounds'     => FightroundsResource::collection($this->whenLoaded('rounds')),
                'round'      => $this->getRound()
            ], $this->mergeTimestamps())
        );
    }

    public static function collection($resource)
    {
        return tap(new FightsResourceCollection($resource), function($collection) {
            $collection->collects = __CLASS__;
        });
    }

    private function getRound(FightRoundsResource $fightRoundsResource)
    {
        
    }
}
