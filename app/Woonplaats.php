<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Woonplaats extends Model
{

    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = "woonplaats";

    protected $fillable = [
        'naam','begin','eind','longitude','latitude','land','provincie','postcode','user_id'
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
