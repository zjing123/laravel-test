<?php

namespace App\Http\Resources;

use App\Http\Resources\Resource;

class FightRoundRecordsResource extends Resource
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
                'id'        => $this->id,
                'round_id'  => $this->round_id,
                'user_id'   => $this->user_id,
                'result'    => $this->result,
                'score'     => $this->score,
                'completed' => $this->completed
            ], parent::toArray($request))
        );
    }

    public static function collection($resource)
    {
        return tap(new FightRoundRecordsResourceCollection($resource), function($collection) {
            $collection->collects = __CLASS__;
        });
    }
}
