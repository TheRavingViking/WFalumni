<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class opleiding extends Model
{
    protected $table = "opleiding";

    protected $fillable = [
        'naam','instituut','richting','begin','eind','locatie','niveau','behaald','land','provincie','user_id'
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }

}
