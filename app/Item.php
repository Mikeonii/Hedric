<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Supplier;
class Item extends Model
{
    public function transactions(){
    	return $this->hasMany('App\Transaction');
    }
    public function supplier(){
    	return $this->belongsTo(Supplier::class);
    }
}
