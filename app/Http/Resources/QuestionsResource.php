<?php

namespace App\Http\Resources;

use App\Models\Answer;

class QuestionsResource extends Resource
{
    public function toArray($request)
    {
        return $this->filterFields([
            'id' => $this->id,
            'title' => $this->title,
            'bad' => $this->bad,
            'good' => $this->good,
            'answers' => AnswersResource::collection($this->whenLoaded('answers')),
        ]);
    }

    public static function collection($resource)
    {
        return tap(new ResourceCollection($resource), function($collection) {
            $collection->collects = __CLASS__;
        });
    }
}
