<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use App;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'voornaam', 'tussenvoegsel', 'achternaam', 'email', 'password', 'geslacht', 'burgerlijke_staat', 'studentnummer', 'post_adres',
        'telefoonnummer', 'geboortedatum', 'geboorteplaats', 'nationaliteit', 'titel', 'geboorteland', 'geboorteprovincie', 'foto',
        'facebook', 'linkedin', 'heeft_kinderen', 'jaarinkomen', 'geenmailverzenden', 'twitter', 'website', 'bevoegdheid', 'afdeling'
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
        return $this->hasMany(Opleiding::class);
    }

    public function bedrijf()
    {
        return $this->hasMany(Bedrijf::class);
    }

    public function woonplaats()
    {
        return $this->hasMany(Woonplaats::class);
    }

    public function comment()
    {
        return $this->hasMany(comment::class);
    }

    public function scopeSearchByKeyword($query, $keyword)
    {
        if ($keyword != '') {
            foreach ($keyword as $keyword)
                $query->where(function ($query) use ($keyword) {
                    $query->where("voornaam", "LIKE", "%$keyword%")
                        ->orWhere("tussenvoegsel", "LIKE", "%$keyword%")
                        ->orWhere("achternaam", "LIKE", "%$keyword%");
                });

        }
        return $query;
    }
}
