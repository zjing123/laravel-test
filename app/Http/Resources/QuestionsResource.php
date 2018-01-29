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
            'answers' => AnswersResource::collection($this->whenLoaded('answers'))->hide(['id', 'created_at', 'updated_at']),
        ]);
    }

    public static function collection($resource)
    {
        return tap(new QuestionsResourceCollection($resource), function($collection) {
            $collection->collects = __CLASS__;
        });
    }
}
