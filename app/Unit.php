<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable = [
        'name',  
    ];
    
    public function materials()
    {
        return $this->hasMany('App\Material');
    }
}
