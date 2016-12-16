<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class dropdown_opleidingen extends Model
{

    use SoftDeletes;
    protected $table = "opleidingen";
    protected $dates = ['deleted_at'];
    protected $fillable = ['naam','richtingen_id'];

    public function specialisaties_dropdown()
    {
        return $this->hasMany(dropdown_specialisaties::class);
    }

    public function richting_dropdown()
    {
        return $this->belongsTo(dropdown_richting::class);
    }


}
