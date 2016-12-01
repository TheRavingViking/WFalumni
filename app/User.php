<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'voornaam', 'achternaam', 'email', 'password', 'geslacht', 'burgerlijke staat', 'studentnummer', 'post adres',
        'telefoonnummer', 'geboortedatum', 'geboorteplaats', 'nationaliteit',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $table = "users";

    public function opleiding()
    {
        return $this->hasMany(opleiding::class);
    }

    public function bedrijf()
    {
        return $this->hasMany(bedrijf::class);
    }

    public function woonplaats()
    {
        return $this->hasMany(woonplaats::class);
    }


}
