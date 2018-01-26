<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'good', 'bad',
    ];

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
