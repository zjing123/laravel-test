<?php

namespace App\Http\Resources;

use Illuminate\Support\Collection;
use App\Http\Resources\Resource;

class FightsResource extends Resource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request, $mergeArr = [])
    {
        return $this->filterFields(
            array_merge([
                'id'           => $this->id,
                'user_id'      => $this->user_id,
                'to_user_id'   => $this->to_user_id,
                'resign'       => $this->resign,
                'turn_user_id' => $this->turn_user_id,
                'completed'    => $this->completed,
                'rounds'       => $this->getRoundList(),
            ], parent::toArray($request))
        );
    }

    public function getRoundList()
    {
        return new FightRoundsResourceCollection($this->whenLoaded('rounds'));
    }

    public static function collection($resource)
    {
        return tap(new FightsResourceCollection($resource), function($collection) {
            $collection->collects = __CLASS__;
        });
    }

    public function with($request)
    {

    }

    private function withIncluded(Collection $included)
    {

    }
}
