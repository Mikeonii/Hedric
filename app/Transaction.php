<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public function item(){
    	return $this->belongsTo('App\Items');
    }
}
