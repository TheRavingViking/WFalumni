<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Specialisaties extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = "specialisaties";

    protected $fillable = ['naam','opleidingen_id'];

    public function Opleiding()
    {
        return $this->belongsTo(Opleidingen::class);
    }
}