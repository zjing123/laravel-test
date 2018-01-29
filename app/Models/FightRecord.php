<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FightRecord extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fight_id', 'user_id', 'question_id', 'result', 'completed'
    ];
}
