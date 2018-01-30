<?php

namespace App\Repositories;

use App\Models\Fight;
use App\Models\FightRound;
use Carbon\Carbon;
use DB;
use Illuminate\Database\QueryException;

class FightRepository
{
    protected $fight;

    public function __construct(Fight $fight)
    {
        $this->fight = $fight;
    }

    public function matchFight($user_id, $question_ids = [])
    {
       return DB::table('fights as a')
                  ->select('a.*')
                  ->leftJoin('fight_rounds as b', 'a.id', '=', 'b.fight_id')
                  ->whereNotIn('b.question_id', $question_ids)
                  ->where('a.to_user_id', 0)
                  ->where('a.user_id', '<>', $user_id)
                  ->first();
    }

    public function createFight($user_id)
    {
        $numbers = config('fight.rounds', 5);
        $questions = app(QuestionRepository::class)->getFightQuestions([], $numbers);

        if (empty($questions)) {
            return null;
        }

        $fight = null;
        DB::beginTransaction();
        try{
            $fight = $this->fight->create([
                'user_id' => $user_id,
                'to_user_id' => 0,
            ]);

            $rounds = [];
            foreach ($questions as $question) {
                $dateTime = Carbon::now();
                $rounds[] = [
                    'fight_id' => $fight->id,
                    'question_id' => $question->id,
                    'created_at' => $dateTime,
                    'updated_at' => $dateTime,
                ];
            }

            FightRound::insert($rounds);

            DB::commit();
        }catch (QueryException $e) {
            throw $e;
            DB::rollback();
            return null;
        }

        if (!empty($fight)) {
            $fight->load('rounds.records');
        }


        return $fight;
    }

}