<?php

use Illuminate\Database\Seeder;
use App\Models\Question;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questions = [
            ['title' => '蔬菜有哪些?'],
            ['title' => '水果有哪些?'],
            ['title' => '动物有哪些?'],
            ['title' => '书桌上有哪些东西?'],
            ['title' => '学校有什么?']
        ];

        Question::insert($questions);
    }
}
