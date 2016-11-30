<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class opleiding extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    protected $table = "opleiding";
}
