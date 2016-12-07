<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bedrijf extends Model

{
    protected $table = "bedrijf";

    protected $fillable = [
        'naam','functie','richting','begin','eind','locatie','telefoonnummer','bezoekadres','land','provincie','user_id'
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }

}