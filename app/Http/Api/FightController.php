<?php

namespace App\Http\Api;

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
        $fights = $request->user()->allFight();
        return $fights;
    }

    public function store(Request $request)
    {
        DB::enableQueryLog();
        $user = $request->user();
        $fightRepository = app(FightRepository::class);
        $fight = $fightRepository->matchFight($user->id);

        if (empty($fight)) {
            $fight = $fightRepository->createFight($user->id);

        }

        return $fight;
        print_r(DB::getQueryLog());exit;
        return $questions;
    }
}
