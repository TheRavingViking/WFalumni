<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bedrijf extends Model

{

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = "bedrijf";

    protected $fillable = [
        'naam','functie','richting','begin','eind','locatie','telefoonnummer','bezoekadres','land','provincie','user_id'
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }

}