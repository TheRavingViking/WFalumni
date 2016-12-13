<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class specialisaties extends Model
{
    protected $table = "specialisaties";

    public function specialisatie_dropdown()
    {
        return $this->belongsTo(opleidingen::class);
    }


}
