<?php

namespace App\Http\Resources;

class AnswersResource extends Resource
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
                'question_id' => $this->question_id,
                'title' => $this->title,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ], parent::toArray($request))
        );
    }

    public static function collection($resource)
    {
        return tap(new AnswersResourceCollection($resource), function($collection) {
            $collection->collects = __CLASS__;
        });
    }
}
