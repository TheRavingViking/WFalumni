<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class opleidingen extends Model
{

    protected $table = "opleidingen";

    public function specialisaties_dropdown()
    {
        return $this->hasMany(specialisaties::class);
    }

    public function richting_dropdown()
    {
        return $this->belongsTo(richting::class);
    }


}
