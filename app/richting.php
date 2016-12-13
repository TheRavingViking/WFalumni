<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class richting extends Model
{
    protected $table = "richtingen";

    public function opleidingen_dropdown()
    {
        return $this->hasMany(opleidingen::class);
    }


}
