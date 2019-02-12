<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'no_book','nama','lapangan','phone','tanggal','dari','sampai','status','struk','reff','total','user','kupon'
    ];
    public function kup() {
    return $this->belongsTo('App\Coupon', 'kupon', 'id');
  }
}
