<?php

namespace App\Http\Resources;

use App\Http\Resources\Resource;

class QuestionsResource extends Resource
{
    public function toArray($request)
    {
        return $this->filterFields(
            array_merge([
                'id' => $this->id,
                'title' => $this->title,
                'bad' => $this->bad,
                'good' => $this->good,
                'answers' => $this->getAnswerList,
            ], parent::toArray($request))
        );
    }

    public function getAnswerList()
    {
        return AnswersResource::collection($this->whenLoaded('answers'))
                                ->hide(['id', 'created_at', 'updated_at']);
    }

    public static function collection($resource)
    {
        return tap(new QuestionsResourceCollection($resource), function($collection) {
            $collection->collects = __CLASS__;
        });
    }
}
