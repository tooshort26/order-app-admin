<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $fillable = ['quantity', 'price', 'name'];
    public $timestamps = false;

    public function sale()
    {
    	return $this->belongsTo('App\Sale');
    }
}
