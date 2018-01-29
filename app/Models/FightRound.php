<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FightRound extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fight_id', 'question_id', 'completed'
    ];

    public function fight()
    {
        return $this->belongsTo(Fight::class);
    }

    public function records()
    {
        return $this->hasMany(FightRoundRecord::class, 'round_id');
    }
}
