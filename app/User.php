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
        'voornaam', 'tussenvoegsel','achternaam', 'email', 'password', 'geslacht', 'burgerlijke_staat', 'studentnummer', 'post_adres',
        'telefoonnummer', 'geboortedatum', 'geboorteplaats', 'nationaliteit', 'titel', 'geboorteland', 'geboorteprovincie', 'foto',
        'facebook', 'linkedin', 'heeft_kinderen', 'jaarinkomen', 'geenmailverzenden', 'twitter', 'website',
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

    public function scopeSearchByKeyword($query, $keyword)
    {
            if ($keyword!='') {
                foreach ($keyword as $keyword)
            $query->where(function ($query) use ($keyword) {
                $query->where("voornaam", "LIKE","%$keyword%")
                    ->orWhere("tussenvoegsel", "LIKE", "%$keyword%")
                    ->orWhere("achternaam", "LIKE", "%$keyword%");
            });

        }
        return $query;
    }



    public function roles()
    {
        return $this->BelongstoMany('App\Role', 'user_role', 'user_id', 'role_id');
    }

    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }

    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }






}
