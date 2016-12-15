<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class personeel extends Model
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
        'voornaam', 'tussenvoegsel','achternaam', 'email', 'password', 'telefoonnummer', 'foto', 'facebook', 'linkedin', 'twitter', 'website',
        'bevoegdheid', 'richting', 'opleiding1', 'opleiding2', 'opleiding3',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $table = "personeel";
}