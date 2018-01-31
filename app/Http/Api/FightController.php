<?php

namespace App\Http\Api;

use App\Http\Resources\FightsResource;
use App\Models\Fight;
use App\Models\Question;
use App\Repositories\QuestionRepository;
use App\Repositories\FightRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FightController extends ApiController
{
    /** @var  QuestionRepository 注入的QuestionRepository */
    protected $questionRepository;

    public function __construct(QuestionRepository $questionRepository)
    {
        $this->questionRepository = $questionRepository;
    }

    public function index(Request $request)
    {
        $fightRepository = app(FightRepository::class);

        $myFightList = $fightRepository->getMyTurnFights($request->user()->id, 2);
        $otherFightList = $fightRepository->getOtherTurnFights($request->user()->id, 2);
        $finishedFightList = $fightRepository->getFinishedFights($request->user()->id);

        return $this->success([
            'myTurn'    => $myFightList,
            'theirTurn' => $otherFightList,
            'finished'  => $finishedFightList
        ]);
    }

    public function store(Request $request)
    {
        DB::enableQueryLog();
        $user = $request->user();
        $fightRepository = app(FightRepository::class);
        $fight = $fightRepository->matchFight($user->id);

//        if (empty($fight)) {
//            $fight = $fightRepository->createFight($user->id);
//
//        }
        $fith = Fight::find(9);
        $fith->load('rounds.records');

        $fight = FightsResource::make($fith);

        $fights = FightsResource::collection(Fight::paginate())->hide(['id']);

        return $fight;
        print_r(DB::getQueryLog());exit;
        return $questions;
    }
}
