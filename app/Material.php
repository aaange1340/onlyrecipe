<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = [
        'name','recipe_id','amount','unit',  
    ];
    
    public function recipe()
    {
        return $this->belongsTo('App/Recipe');
    }
}
