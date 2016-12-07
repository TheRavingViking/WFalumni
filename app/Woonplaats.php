<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Woonplaats extends Model
{
    protected $table = "woonplaats";

    protected $fillable = [
        'naam','begin','eind','longitude','latitude','land','provincie','user_id'
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
