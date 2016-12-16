<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class dropdown_richting extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = ['naam'];
    protected $table = "richtingen";

    public function opleidingen_dropdown()
    {
        return $this->hasMany(dropdown_opleidingen::class);
    }


}
