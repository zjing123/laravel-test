<?php

namespace App\Repositories;

use App\Models\Question;
use DB;

class QuestionRepository
{
    /**
     * @var Question 注入的Question Model
     */
    protected $question;

    public function __construct(Question $question)
    {
        $this->question = $question;
    }

    public function getFightQuestions($ids = [], $num = 5)
    {
        $count = $this->question->count();

        if ($count >= 1000) {
            $questions = DB::table('questions as t1')
                ->join(DB::raw(
                    "(SELECT 
                    ROUND(
                      RAND()*(
                         (SELECT MAX(id) FROM questions)
                         -
                         (SELECT MIN(id) FROM questions)
                      )
                      +
                      (SELECT MIN(id) FROM questions)
                    )
                AS id
                ) AS t2"
                ), 't1.id', '>=', 't2.id')
                ->whereNotIN('t1.id', $ids)
                ->limit($num)
                ->get();
        } else {
            $questions = $this->question
                         ->whereNotIn('id', $ids)
                         ->take(5)
                         ->get();
        }


        return $questions;
    }
}