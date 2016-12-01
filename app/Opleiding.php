<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class opleiding extends Model
{
    protected $table = "opleiding";

    public function Opleiding()
    {
        return $this->belongsTo(User::class);
    }

}
