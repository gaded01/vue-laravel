<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'birthdate',
        'gender',
        'username',
        'password',
    ];

    protected $appends = [
        'formatted_gender',
        'formatted_birthdate'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function pokemonHate()
    {
        return $this->hasMany(PokemonHate::class, 'user_id', 'id');
    }
    public function pokemonLike()
    {
        return $this->hasMany(PokemonLike::class, 'user_id', 'id');
    }
    public function pokemonFavorite()
    {
        return $this->hasOne(PokemonFavorite::class, 'user_id', 'id');
    }

    public function getFormattedBirthdateAttribute()
    {
        if(!@$this->attributes['birthdate']) return;
        return Carbon::parse($this->attributes['birthdate'])->format('F d, Y');
    }
    
    public function getFormattedGenderAttribute()
    {
        if(!@$this->id) return;

        else if($this->attributes["gender"] == "0") return "Male";
        
        else if($this->attributes["gender"]  == "1") return "Female";

        else if($this->attributes["gender"]  == "3") return "Others";

    }
}
