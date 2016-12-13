<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class dropdown_richting extends Model
{
    protected $table = "richtingen";

    public function opleidingen_dropdown()
    {
        return $this->hasMany(dropdown_opleidingen::class);
    }


}
