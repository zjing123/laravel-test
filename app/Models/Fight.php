<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fight extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'to_user_id', 'questions', 'resign', 'enable_match', 'completed'
    ];

    public function rounds()
    {
        return $this->hasMany(FightRound::class);
    }
}
