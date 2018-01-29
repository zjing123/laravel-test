<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuggestAnswer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'good', 'bad',
    ];
}
