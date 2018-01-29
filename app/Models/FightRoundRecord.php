<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FightRoundRecord extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'round_id', 'user_id', 'result', 'completed'
    ];

    public function round()
    {
        return $this->belongsTo(FightRound::class, 'round_id');
    }
}
