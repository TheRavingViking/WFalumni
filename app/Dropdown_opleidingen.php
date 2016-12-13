<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class dropdown_opleidingen extends Model
{

    protected $table = "opleidingen";

    public function specialisaties_dropdown()
    {
        return $this->hasMany(dropdown_specialisaties::class);
    }

    public function richting_dropdown()
    {
        return $this->belongsTo(dropdown_richting::class);
    }


}
