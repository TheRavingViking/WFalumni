<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Opleidingen extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = "opleidingen";

    protected $fillable = ['naam','richtingen_id'];

    public function Richting()
    {
        return $this->belongsTo(Richtingen::class);
    }
}