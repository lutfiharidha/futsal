<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usertour extends Model
{
	public $timestamps = false;
    protected $fillable = [
        'tour', 'club', 'pemain','province','city','status','phone','ref','struk'
    ];
    public function prov() {
    return $this->belongsTo('App\Province', 'province', 'id');
  }
  public function cat() {
    return $this->belongsTo('App\Regencie', 'city', 'id');
  }
  public function tour() {
    return $this->belongsTo('App\Tournament', 'tour', 'id');
  }
}
