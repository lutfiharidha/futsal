<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'user','status','code','batas','id'
    ];
public function us() {
    return $this->belongsTo('App\User', 'user', 'id');
  }
}
