<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',  
    ];
    
    public function recipes()
    {
        return $this->hasMany('App\Recipe');
    }
}
