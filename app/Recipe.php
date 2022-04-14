<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = [
      'name','category_id','image','user_id',
    ];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function category()
    {
      return $this->belongsTo('App\Category');
    }
}
