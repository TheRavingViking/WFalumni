<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Comment extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = "comments";

    protected $fillable = [
        'comment', 'rating', 'user_id', 'docent_id',
    ];


    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
