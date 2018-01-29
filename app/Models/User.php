<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function fights()
    {
        return $this->hasMany(Fight::class);
    }

    public function fightings()
    {
        return $this->hasMany(Fight::class, 'to_user_id');
    }

    public function allFight()
    {
        $fights = $this->fights()->with('rounds.records')->get();
        $fightings = $this->fightings;

        return $fights;
    }
}
