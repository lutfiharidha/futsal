<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    protected $fillable = [
        'tournament', 'syarat', 'description','status','image','club'
    ];
}
