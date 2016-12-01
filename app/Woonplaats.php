<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Woonplaats extends Model
{
    protected $table = "woonplaats";

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
