<?php

namespace App\Http\Resources;

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
        return $this->filterFields([
            'id' => $this->id,
            'fight_id' => $this->fight_id,
            'question_id' => $this->question_id,
            'completed' => $this->completed,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);
    }

    public static function collection($resource)
    {
        return tap(new FightRoundsResourceCollection($resource), function($collection) {
            $collection->collects = __CLASS__;
        });
    }
}
