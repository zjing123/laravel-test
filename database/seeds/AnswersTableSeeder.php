<?php

use Illuminate\Database\Seeder;
use App\Models\Question;
use App\Models\Answer;

class AnswersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $minQuestionId = Question::min('id');
        $answers = [
            ['question_id' => $minQuestionId, 'title' => '白菜'],
            ['question_id' => $minQuestionId, 'title' => '萝卜'],
            ['question_id' => $minQuestionId, 'title' => '黄瓜'],
            ['question_id' => $minQuestionId, 'title' => '茄子'],
            ['question_id' => $minQuestionId, 'title' => '冬瓜'],
        ];

        $minQuestionId++;
        $answers = array_merge($answers, [
            ['question_id' => $minQuestionId, 'title' => '苹果'],
            ['question_id' => $minQuestionId, 'title' => '香蕉'],
            ['question_id' => $minQuestionId, 'title' => '梨子'],
            ['question_id' => $minQuestionId, 'title' => '葡萄'],
            ['question_id' => $minQuestionId, 'title' => '桔子'],
        ]);

        $minQuestionId++;
        $answers = array_merge($answers, [
            ['question_id' => $minQuestionId, 'title' => '猫'],
            ['question_id' => $minQuestionId, 'title' => '狗'],
            ['question_id' => $minQuestionId, 'title' => '猪'],
            ['question_id' => $minQuestionId, 'title' => '牛'],
            ['question_id' => $minQuestionId, 'title' => '羊'],
        ]);

        $minQuestionId++;
        $answers = array_merge($answers, [
            ['question_id' => $minQuestionId, 'title' => '铅笔'],
            ['question_id' => $minQuestionId, 'title' => '钢笔'],
            ['question_id' => $minQuestionId, 'title' => '纸'],
            ['question_id' => $minQuestionId, 'title' => '书'],
            ['question_id' => $minQuestionId, 'title' => '橡皮擦'],
        ]);

        $minQuestionId++;
        $answers = array_merge($answers, [
            ['question_id' => $minQuestionId, 'title' => '学生'],
            ['question_id' => $minQuestionId, 'title' => '老师'],
            ['question_id' => $minQuestionId, 'title' => '教授'],
            ['question_id' => $minQuestionId, 'title' => '校长'],
            ['question_id' => $minQuestionId, 'title' => '助教'],
        ]);

        Answer::insert($answers);
    }
}
