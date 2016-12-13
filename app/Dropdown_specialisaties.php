<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class dropdown_specialisaties extends Model
{
    protected $table = "specialisaties";

    public function specialisatie_dropdown()
    {
        return $this->belongsTo(dropdown_opleidingen::class);
    }


}
