<?php

namespace App\Repositories;

use App\Http\Resources\FightsResource;
use App\Models\Fight;
use App\Models\FightRound;
use App\Models\User;
use Carbon\Carbon;
use DB;
use Illuminate\Database\QueryException;

class FightRepository
{
    protected $fight;
    protected $user;

    public function __construct()
    {
        $this->fight = app(Fight::class);
        $this->user = app(User::class);
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

    public function getMyTurnFights($user_id, $limit = 5)
    {
        $fights = $this->user
                       ->find($user_id)
                       ->fights()
                       ->with('rounds')
                       ->where('completed', 0)
                       ->where('turn_user_id', $user_id)
                       ->limit($limit)
                       ->get();

        $fightings = $this->user
                          ->find($user_id)
                          ->fightings()
                          ->with('rounds')
                          ->where('completed', 0)
                          ->where('turn_user_id', $user_id)
                          ->limit($limit)
                          ->get();

        $multipliedFight = $fights->merge($fightings);

        FightsResource::withoutWrapping();
        $multipliedFight = FightsResource::collection($multipliedFight);
        $multipliedFight->collection->transform(function ($fight) {
            $fight->addFields('info', $this->addAttributesToFightResource($fight));
            return $fight;
        });

        return $multipliedFight;
    }

    public function getOtherTurnFights($user_id, $limit = 5)
    {
        $fights = $this->user
                       ->find($user_id)
                       ->fights()
                       ->where('completed', 0)
                       ->where('turn_user_id', '<>', $user_id)
                       ->limit($limit)
                       ->get();

        $fightings = $this->user
                          ->find($user_id)
                          ->fightings()
                          ->where('completed', 0)
                          ->where('turn_user_id', '<>', $user_id)
                          ->limit($limit)
                          ->get();

        $multipliedFight = $fights->merge($fightings);

        FightsResource::withoutWrapping();
        $multipliedFight = FightsResource::collection($multipliedFight);
        $multipliedFight->collection->transform(function ($fight) {
            $fight->addFields('info', $this->addAttributesToFightResource($fight));
            return $fight;
        });

        return $multipliedFight;
    }

    public function getFinishedFights($user_id, $limit = 5)
    {
        $fights = $this->user
                       ->find($user_id)
                       ->fights()
                       ->where('completed', 1)
                       ->limit($limit)
                       ->get();

        $fightings = $this->user
                          ->find($user_id)
                          ->fightings()
                          ->where('completed', 1)
                          ->limit($limit)
                          ->get();

        $multipliedFight = $fights->merge($fightings);

        FightsResource::withoutWrapping();
        $multipliedFight = FightsResource::collection($multipliedFight);
        $multipliedFight->collection->transform(function ($fight) {
            $fight->addFields('info', $this->addAttributesToFightResource($fight));
            return $fight;
        });

        return $multipliedFight;
    }

    private function addAttributesToFightResource($fight)
    {
        $turnInfo = null;
        if ($fight instanceof FightsResource) {
            $turnInfo = [
                'round' => 1,
                'score' => [
                    $fight->user_id => 0,
                    $fight->to_user_id => 0
                ],
                'lead' => null
            ];

            if (isset($fight->rounds)) {
                foreach ($fight->rounds as $round) {
                    if($round->completed === 1) {
                        $turnInfo['round'] += 1;
                    }

                    if (isset($round->records)) {
                        foreach ($round->records as $record) {
                            if ($record->completed) {
                                $turnInfo['score'][$record->user_id] += $record->score;
                            }
                        }
                    }
                }
            }

            $turnInfo['lead'] = $turnInfo['score'][$fight->user_id] > $turnInfo['score'][$fight->to_user_id] ? $fight->user_id : $fight->to_user_id;
            if ($turnInfo['score'][$fight->user_id] == $turnInfo['score'][$fight->to_user_id]) {
                $turnInfo['lead'] = 0;
            }
        }

        return $turnInfo;
    }

}