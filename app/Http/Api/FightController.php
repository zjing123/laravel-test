<?php

namespace App\Http\Api;

use App\Models\Fight;
use App\Models\Question;
use App\Repositories\QuestionRepository;
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
        $user = $request->user();
        $fight = Fight::where('to_user_id', 0)
            ->where('user_id', '<>', $user->id)
            ->first();

        $rounds = config('fight.rounds', 5);

        DB::enableQueryLog();
        $questions = $this->questionRepository->getFightQuestions();
        print_r(DB::getQueryLog());exit;
        return $questions;
    }
}
