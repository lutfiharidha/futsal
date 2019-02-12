<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    protected $fillable = [
        'name','image','fasilitas','pemesanan','harga','status'
    ];
}
