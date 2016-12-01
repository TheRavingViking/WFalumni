<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bedrijf extends Model

{
    protected $table = "bedrijf";

    public function User()
    {
        return $this->belongsTo(User::class);
    }

}