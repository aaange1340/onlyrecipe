<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nationality extends Model
{
    protected $fillable = [
        'name','user_id',  
    ];
    
    public function users()
    {
        return $this->hasMany('App\User');
    }
}
