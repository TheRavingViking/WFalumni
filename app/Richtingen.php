<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Richtingen extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = "richtingen";

    protected $fillable = ['naam'];
}
