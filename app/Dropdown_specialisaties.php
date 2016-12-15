<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class dropdown_specialisaties extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = "specialisaties";
    protected $fillable = ['naam','opleidingen_id'];

    public function specialisatie_dropdown()
    {
        return $this->belongsTo(dropdown_opleidingen::class);
    }


}
