<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class opleiding extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = "opleiding";

    protected $fillable = [
        'naam','instituut','richting','begin','eind','locatie','niveau','behaald','land','provincie','user_id'
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }

}
